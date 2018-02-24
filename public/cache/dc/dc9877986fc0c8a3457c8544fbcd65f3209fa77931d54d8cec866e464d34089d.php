<?php

/* despatch.html.twig */
class __TwigTemplate_b289bc7694d9ea0e77898bd35257c3001de44f997cd43feef84621953c2930a4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
    <style type=\"text/css\">
        ";
        // line 5
        $this->loadTemplate("assets/style.css", "despatch.html.twig", 5)->display($context);
        echo "td{padding: 3px;}
    </style>
</head>
<body class=\"white-bg\">
";
        // line 9
        $context["cp"] = $this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "company", array());
        // line 10
        $context["name"] = $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog($this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "tipoDoc", array()), "01");
        // line 11
        echo "<table width=\"100%\">
    <tbody><tr>
        <td style=\"padding:30px; !important\">
            <table width=\"100%\" height=\"200px\" border=\"0\" aling=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tbody><tr>
                    <td width=\"50%\" height=\"90\" align=\"center\">
                        <span><img src=\"";
        // line 17
        echo $this->env->getRuntime('Greenter\Report\Filter\ImageFilter')->toBase64($this->getAttribute($this->getAttribute(($context["params"] ?? $this->getContext($context, "params")), "system", array()), "logo", array()));
        echo "\" height=\"80\" style=\"text-align:center\" border=\"0\"></span>
                    </td>
                    <td width=\"5%\" height=\"40\" align=\"center\"></td>
                    <td width=\"45%\" rowspan=\"2\" valign=\"bottom\" style=\"padding-left:0\">
                        <div class=\"tabla_borde\">
                            <table width=\"100%\" border=\"0\" height=\"200\" cellpadding=\"6\" cellspacing=\"0\">
                                <tbody><tr>
                                    <td align=\"center\">
                                        <span style=\"font-family:Tahoma, Geneva, sans-serif; font-size:29px\" text-align=\"center\">";
        // line 25
        echo ($context["name"] ?? $this->getContext($context, "name"));
        echo "</span>
                                        <br>
                                        <span style=\"font-family:Tahoma, Geneva, sans-serif; font-size:19px\" text-align=\"center\">E L E C T R Ó N I C A</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"center\">
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"center\">
                                        <span style=\"font-size:15px\" text-align=\"center\">R.U.C.: ";
        // line 37
        echo $this->getAttribute(($context["cp"] ?? $this->getContext($context, "cp")), "ruc", array());
        echo "</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"center\">
                                        No.: <span>";
        // line 42
        echo $this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "serie", array());
        echo "-";
        echo $this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "correlativo", array());
        echo "</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"center\">
                                        Nro. R.I. Emisor: <span>";
        // line 47
        echo $this->getAttribute($this->getAttribute(($context["params"] ?? $this->getContext($context, "params")), "user", array()), "resolucion", array());
        echo "</span>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign=\"bottom\" style=\"padding-left:0\">
                        <div class=\"tabla_borde\">
                            <table width=\"96%\" height=\"100%\" border=\"0\" border-radius=\"\" cellpadding=\"9\" cellspacing=\"0\">
                                <tbody><tr>
                                    <td align=\"center\">
                                        <strong><span style=\"font-size:15px\">";
        // line 60
        echo $this->getAttribute(($context["cp"] ?? $this->getContext($context, "cp")), "razonSocial", array());
        echo "</span></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"left\">
                                        <strong>Dirección: </strong>";
        // line 65
        echo $this->getAttribute($this->getAttribute(($context["cp"] ?? $this->getContext($context, "cp")), "address", array()), "direccion", array());
        echo "
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"left\">
                                        ";
        // line 70
        echo $this->getAttribute($this->getAttribute(($context["params"] ?? $this->getContext($context, "params")), "user", array()), "header", array());
        echo "
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>
                    </td>
                </tr>
                </tbody></table>
            <br>
            <div class=\"tabla_borde\">
                ";
        // line 80
        $context["cl"] = $this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "destinatario", array());
        // line 81
        echo "                <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                    <tbody>
                    <tr>
                        <td colspan=\"2\">DESTINATARIO</td>
                    </tr>
                    <tr class=\"border_top\">
                        <td width=\"60%\" align=\"left\"><strong>Razón Social:</strong>  ";
        // line 87
        echo $this->getAttribute(($context["cl"] ?? $this->getContext($context, "cl")), "rznSocial", array());
        echo "</td>
                        <td width=\"40%\" align=\"left\"><strong>";
        // line 88
        echo $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog($this->getAttribute(($context["cl"] ?? $this->getContext($context, "cl")), "tipoDoc", array()), "06");
        echo ":</strong>  ";
        echo $this->getAttribute(($context["cl"] ?? $this->getContext($context, "cl")), "numDoc", array());
        echo "</td>
                    </tr>
                    <tr>
                        <td width=\"40%\" align=\"left\" colspan=\"2\"><strong>Dirección:</strong>  ";
        // line 91
        if ($this->getAttribute(($context["cl"] ?? $this->getContext($context, "cl")), "address", array())) {
            echo $this->getAttribute($this->getAttribute(($context["cl"] ?? $this->getContext($context, "cl")), "address", array()), "direccion", array());
        }
        echo "</td>
                    </tr>
                    </tbody></table>
            </div><br>
            <div class=\"tabla_borde\">
                ";
        // line 96
        $context["cl"] = $this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "destinatario", array());
        // line 97
        echo "                <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                    <tbody>
                    <tr>
                        <td colspan=\"2\">ENVIO</td>
                    </tr>
                    <tr class=\"border_top\">
                        <td width=\"60%\" align=\"left\">
                            <strong>Fecha Emisión:</strong>  ";
        // line 104
        echo twig_date_format_filter($this->env, $this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "fechaEmision", array()), "d/m/Y");
        echo "
                        </td>
                        <td width=\"40%\" align=\"left\"><strong>Fecha Inicio de Traslado:</strong>  ";
        // line 106
        echo twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "envio", array()), "fecTraslado", array()), "d/m/Y");
        echo " </td>
                    </tr>
                    <tr>
                        <td width=\"60%\" align=\"left\"><strong>Motivo Traslado:</strong>  ";
        // line 109
        echo $this->getAttribute($this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "envio", array()), "desTraslado", array());
        echo " </td>
                        <td width=\"40%\" align=\"left\"><strong>Modalidad de Transporte:</strong>  ";
        // line 110
        echo $this->getAttribute($this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "envio", array()), "modTraslado", array());
        echo " </td>
                    </tr>
                    <tr>
                        <td width=\"60%\" align=\"left\"><strong>Peso Bruto Total (";
        // line 113
        echo $this->getAttribute($this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "envio", array()), "undPesoTotal", array());
        echo "):</strong>  ";
        echo $this->getAttribute($this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "envio", array()), "pesoTotal", array());
        echo "% </td>
                        <td width=\"40%\">";
        // line 114
        if ($this->getAttribute($this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "envio", array()), "numBultos", array())) {
            echo "<strong>Número de Bultos:</strong>  ";
            echo $this->getAttribute($this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "envio", array()), "numBultos", array());
        }
        echo "</td>
                    </tr>
                    <tr>
                        <td width=\"60%\" align=\"left\"><strong>P. Partida:</strong>  ";
        // line 117
        echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "envio", array()), "partida", array()), "ubigueo", array());
        echo " - ";
        echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "envio", array()), "partida", array()), "direccion", array());
        echo "</td>
                        <td width=\"40%\" align=\"left\"><strong>P. Llegada: </strong>  ";
        // line 118
        echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "envio", array()), "llegada", array()), "ubigueo", array());
        echo " - ";
        echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "envio", array()), "llegada", array()), "direccion", array());
        echo "</td>
                    </tr>
                    </tbody></table>
            </div><br>
            ";
        // line 122
        $context["tr"] = $this->getAttribute($this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "envio", array()), "transportista", array());
        // line 123
        echo "            ";
        if (($context["tr"] ?? $this->getContext($context, "tr"))) {
            // line 124
            echo "            <div class=\"tabla_borde\">
                <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                    <tbody>
                    <tr>
                        <td colspan=\"2\">TRANSPORTE</td>
                    </tr>
                    <tr class=\"border_top\">
                        <td width=\"60%\" align=\"left\"><strong>Razón Social:</strong>  ";
            // line 131
            echo $this->getAttribute(($context["tr"] ?? $this->getContext($context, "tr")), "rznSocial", array());
            echo "</td>
                        <td width=\"40%\" align=\"left\"><strong>";
            // line 132
            echo $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog($this->getAttribute(($context["tr"] ?? $this->getContext($context, "tr")), "tipoDoc", array()), "06");
            echo ":</strong>  ";
            echo $this->getAttribute(($context["tr"] ?? $this->getContext($context, "tr")), "numDoc", array());
            echo "</td>
                    </tr>
                    <tr>
                        <td width=\"60%\" align=\"left\"><strong>Vehiculo:</strong>  ";
            // line 135
            echo $this->getAttribute(($context["tr"] ?? $this->getContext($context, "tr")), "placa", array());
            echo "</td>
                        <td width=\"40%\" align=\"left\"><strong>Conductor:</strong>  ";
            // line 136
            echo $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog($this->getAttribute(($context["tr"] ?? $this->getContext($context, "tr")), "choferTipoDoc", array()), "06");
            echo " ";
            echo $this->getAttribute(($context["tr"] ?? $this->getContext($context, "tr")), "choferDoc", array());
            echo "</td>
                    </tr>
                    </tbody></table>
            </div><br>
            ";
        }
        // line 141
        echo "            <div class=\"tabla_borde\">
                <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                    <tbody>
                    <tr>
                        <td align=\"center\" class=\"bold\">Item</td>
                        <td align=\"center\" class=\"bold\">Código</td>
                        <td align=\"center\" class=\"bold\" width=\"300px\">Descripción</td>
                        <td align=\"center\" class=\"bold\">Unidad</td>
                        <td align=\"center\" class=\"bold\">Cantidad</td>
                    </tr>
                        ";
        // line 151
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "details", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["det"]) {
            // line 152
            echo "                        <tr class=\"border_top\">
                            <td align=\"center\">";
            // line 153
            echo $this->getAttribute($context["loop"], "index", array());
            echo "</td>
                            <td align=\"center\">";
            // line 154
            echo $this->getAttribute($context["det"], "codigo", array());
            echo "</td>
                            <td align=\"center\">";
            // line 155
            echo $this->getAttribute($context["det"], "descripcion", array());
            echo "</td>
                            <td align=\"center\">";
            // line 156
            echo $this->getAttribute($context["det"], "unidad", array());
            echo "</td>
                            <td align=\"center\">";
            // line 157
            echo $this->getAttribute($context["det"], "cantidad", array());
            echo "</td>
                        </tr>
                        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['det'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 160
        echo "                    </tbody>
                </table></div>
            <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                <tbody><tr>
                    <td width=\"50%\" valign=\"top\">
                        <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                            <tbody>
                            <tr>
                                <td colspan=\"4\">
                                ";
        // line 169
        if ($this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "observacion", array())) {
            // line 170
            echo "                                    <br><br>
                                    <span style=\"font-family:Tahoma, Geneva, sans-serif; font-size:12px\" text-align=\"center\"><strong>Observaciones</strong></span>
                                    <br>
                                    <p>";
            // line 173
            echo $this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "observacion", array());
            echo "</p>
                                ";
        }
        // line 175
        echo "                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width=\"50%\" valign=\"top\"></td>
                </tr>
                </tbody></table>
            ";
        // line 183
        if ((array_key_exists("max_items", $context) && (twig_length_filter($this->env, $this->getAttribute(($context["doc"] ?? $this->getContext($context, "doc")), "details", array())) > ($context["max_items"] ?? $this->getContext($context, "max_items"))))) {
            // line 184
            echo "                <div style=\"page-break-after:always;\"></div>
            ";
        }
        // line 186
        echo "            <div>
            <table>
                <tbody>
                <tr><td width=\"100%\">
                    <blockquote>
                        ";
        // line 191
        if ($this->getAttribute($this->getAttribute(($context["params"] ?? null), "user", array(), "any", false, true), "footer", array(), "any", true, true)) {
            // line 192
            echo "                            ";
            echo $this->getAttribute($this->getAttribute(($context["params"] ?? $this->getContext($context, "params")), "user", array()), "footer", array());
            echo "
                        ";
        }
        // line 194
        echo "                        ";
        if (($this->getAttribute($this->getAttribute(($context["params"] ?? null), "system", array(), "any", false, true), "hash", array(), "any", true, true) && $this->getAttribute($this->getAttribute(($context["params"] ?? $this->getContext($context, "params")), "system", array()), "hash", array()))) {
            // line 195
            echo "                            <strong>Resumen:</strong>   ";
            echo $this->getAttribute($this->getAttribute(($context["params"] ?? $this->getContext($context, "params")), "system", array()), "hash", array());
            echo "<br>
                        ";
        }
        // line 197
        echo "                        <span>Representación Impresa de la ";
        echo ($context["name"] ?? $this->getContext($context, "name"));
        echo " ELECTRÓNICA.</span>
                    </blockquote>
                    </td>
                </tr>
                </tbody></table>
            </div>
        </td>
    </tr>
    </tbody></table>
</body></html>";
    }

    public function getTemplateName()
    {
        return "despatch.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  395 => 197,  389 => 195,  386 => 194,  380 => 192,  378 => 191,  371 => 186,  367 => 184,  365 => 183,  355 => 175,  350 => 173,  345 => 170,  343 => 169,  332 => 160,  315 => 157,  311 => 156,  307 => 155,  303 => 154,  299 => 153,  296 => 152,  279 => 151,  267 => 141,  257 => 136,  253 => 135,  245 => 132,  241 => 131,  232 => 124,  229 => 123,  227 => 122,  218 => 118,  212 => 117,  203 => 114,  197 => 113,  191 => 110,  187 => 109,  181 => 106,  176 => 104,  167 => 97,  165 => 96,  155 => 91,  147 => 88,  143 => 87,  135 => 81,  133 => 80,  120 => 70,  112 => 65,  104 => 60,  88 => 47,  78 => 42,  70 => 37,  55 => 25,  44 => 17,  36 => 11,  34 => 10,  32 => 9,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "despatch.html.twig", "D:\\Proyecto2018\\SistemaControlV1.1\\vendor\\greenter\\report\\src\\Report\\Templates\\despatch.html.twig");
    }
}
