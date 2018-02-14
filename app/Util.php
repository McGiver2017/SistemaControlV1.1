<?php
namespace App;

use Greenter\Model\Company\Address;
use Greenter\Model\Client\Client;
use Greenter\Model\Company\Company;
use Greenter\Model\DocumentInterface;
use Greenter\Model\Response\CdrResponse;
use Greenter\Report\HtmlReport;
use Greenter\Report\PdfReport;
use Greenter\See;
use Greenter\Validator\XmlErrorCodeProvider;


use App\usuario;
use App\empresa;
use App\cliente;
use Illuminate\Support\Facades\Storage;

final class Util
{
    public static function getClient($id)
    {        
        $cliente = cliente::find($id);
        $client = new Client();
        $client->setTipoDoc($cliente->tipo_doc)
            ->setNumDoc($cliente->num_doc)
            ->setRznSocial($cliente->razon_social)
            ->setAddress((new Address())
                ->setDireccion($cliente->direccion));
               // ->setUbigueo('250101'));

        return $client;
    }

   public static function getCompany()
    {
        return (new Company())
            ->setRuc('20394061361')
            ->setNombreComercial('GRUPO CORPORATIVO ALANIA S.A.C.')
            ->setRazonSocial('GRUPO CORPORATIVO ALANIA S.A.C.')
            ->setAddress((new Address())
                ->setDireccion('JR. TUPAC AMARU MZA. C LOTE. 18')
                ->setUbigueo('250105'));
    }

    /**
     * @param string $endpoint
     * @return See
    */
    public static function getSee($endpoint)
    {   
        $see = new See();
        $see->setService($endpoint);
        $see->setCodeProvider(new XmlErrorCodeProvider());
        $see->setCertificate(file_get_contents(__DIR__ . '/../public/resources/cert.pem'));
        $see->setCredentials('20394061361MCGIVER7', 'mcgiver12');
        $see->setCachePath(__DIR__ . '/../public/cache');

        return $see;
    }

   public function getResponseFromCdr(CdrResponse $cdr)
    {
        $result = <<<HTML
        <h2>Respuesta SUNAT:</h2><br>
        <b>ID:</b> {$cdr->getId()}<br>
        <b>CODE:</b>{$cdr->getCode()}<br>
        <b>DESCRIPTION:</b>{$cdr->getDescription()}<br>
HTML;

        return $result;
    }

    public static function writeXml(DocumentInterface $document, $xml)
    {
        if (getenv('GREENTER_NO_FILES')) {
            return;
        }
        file_put_contents(__DIR__ . '/../public/files/' . $document->getName() . '.xml', $xml);
    }

    public static function writeCdr(DocumentInterface $document, $zip)
    {
        if (getenv('GREENTER_NO_FILES')) {
            return;
        }
        file_put_contents(__DIR__ . '/../public/files/R-' . $document->getName() . '.zip', $zip);
    }

    public function getPdf(DocumentInterface $document)
    {
        $html = new HtmlReport('', [
            'cache' => __DIR__ . '/../public/cache',
            'strict_variables' => true,
        ]);
        $template = $this->getTemplate($document);
        if ($template) {
            $html->setTemplate($template);
        }

        $render = new PdfReport($html);
        $render->setOptions( [
            'no-outline',
            'viewport-size' => '1280x1024',
            'page-width' => '21cm',
            'page-height' => '29.7cm',
            'footer-html' => __DIR__.'/../public/resources/footer.html',
        ]);
        $binPath = self::getPathBin();
        if (file_exists($binPath)) {
            $render->setBinPath($binPath);
        }
        $hash = $this->getHash($document);
        $params = self::getParametersPdf();
        $params['system']['hash'] = $hash;
        $params['user']['footer'] = '<div>consulte en <a href="https://github.com/giansalex/sufel">sufel.com</a></div>';

        return $render->render($document, $params);
    }

    public static function generator($item, $count)
    {
        $items = [];

        for ($i = 0; $i < $count; $i++) {
            $items[] = $item;
        }

        return $items;
    }

    public static function showPdf($content, $filename)
    {
        self::writePdf($filename, $content);
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($content));

        echo $content;
    }

    public static function getPathBin()
    {
        $path = __DIR__.'/../vendor/bin/wkhtmltopdf';
        if (self::isWindows()) {
            $path .= '.exe';
        }

        return $path;
    }

    public static function isWindows()
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }

    private function getTemplate($document)
    {
        $className = get_class($document);

        switch ($className) {
            case \Greenter\Model\Retention\Retention::class:
                $name = 'retention';
                break;
            case \Greenter\Model\Perception\Perception::class:
                $name = 'perception';
                break;
            case \Greenter\Model\Despatch\Despatch::class:
                $name = 'despatch';
                break;
            case \Greenter\Model\Summary\Summary::class:
                $name = 'summary';
                break;
            case \Greenter\Model\Voided\Voided::class:
            case \Greenter\Model\Voided\Reversion::class:
                $name = 'voided';
                break;
            default:
                return '';
        }

        return $name.'.html.twig';
    }

    private function getHash(DocumentInterface $document)
    {
        $see = $this->getSee('');
        $xml = $see->getXmlSigned($document);

        $hash = (new \Greenter\Report\XmlUtils())->getHashSign($xml);

        return $hash;
    }

    private static function writePdf($filename, $content)
    {
        if (getenv('GREENTER_NO_FILES')) {
            return;
        }
        file_put_contents(__DIR__ . '/../public/files/'.$filename, $content);
    }

    private static function getParametersPdf()
    {
        $logo = file_get_contents(__DIR__.'/../public/resources/logo.png');

        return [
            'system' => [
                'logo' => $logo,
                'hash' => ''
            ],
            'user' => [
                'resolucion' => '212321',
                'header' => 'Telf: <b>(056) 123375</b>',
                'extras' => [
                    ['name' => 'CONDICION DE PAGO', 'value' => 'Efectivo'],
                    ['name' => 'VENDEDOR', 'value' => 'PUCALLPA-LOVERS'],
                ],
            ]
        ];
    }
}