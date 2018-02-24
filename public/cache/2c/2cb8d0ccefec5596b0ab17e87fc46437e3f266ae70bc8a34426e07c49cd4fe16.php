<?php

/* despatch.xml.twig */
class __TwigTemplate_5ad274a6713056a3bffd23b5b5b3b7c0ff7c7e74b116162c7bf42bf9c4c867dd extends Twig_Template
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
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<DespatchAdvice xmlns=\"urn:oasis:names:specification:ubl:schema:xsd:DespatchAdvice-2\"
\t\t\t\txmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\"
\t\t\t\txmlns:cac=\"urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2\"
\t\t\t\txmlns:cbc=\"urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2\"
\t\t\t\txmlns:ext=\"urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2\">
\t<ext:UBLExtensions>
\t\t<ext:UBLExtension>
\t\t\t<ext:ExtensionContent/>
\t\t</ext:UBLExtension>
\t</ext:UBLExtensions>
\t<cbc:UBLVersionID>2.1</cbc:UBLVersionID>
\t<cbc:CustomizationID>1.0</cbc:CustomizationID>
\t<cbc:ID>";
        // line 14
        echo $this->getAttribute(($context["doc"] ?? null), "serie", array());
        echo "-";
        echo $this->getAttribute(($context["doc"] ?? null), "correlativo", array());
        echo "</cbc:ID>
\t<cbc:IssueDate>";
        // line 15
        echo twig_date_format_filter($this->env, $this->getAttribute(($context["doc"] ?? null), "fechaEmision", array()), "Y-m-d");
        echo "</cbc:IssueDate>
\t<cbc:IssueTime>";
        // line 16
        echo twig_date_format_filter($this->env, $this->getAttribute(($context["doc"] ?? null), "fechaEmision", array()), "H:i:s");
        echo "</cbc:IssueTime>
\t<cbc:DespatchAdviceTypeCode>";
        // line 17
        echo $this->getAttribute(($context["doc"] ?? null), "tipoDoc", array());
        echo "</cbc:DespatchAdviceTypeCode>
    ";
        // line 18
        if ($this->getAttribute(($context["doc"] ?? null), "observacion", array())) {
            // line 19
            echo "<cbc:Note><![CDATA[";
            echo $this->getAttribute(($context["doc"] ?? null), "observacion", array());
            echo "]]></cbc:Note>
    ";
        }
        // line 21
        if ($this->getAttribute(($context["doc"] ?? null), "docBaja", array())) {
            // line 22
            echo "<cac:OrderReference>
\t\t<cbc:ID>";
            // line 23
            echo $this->getAttribute($this->getAttribute(($context["doc"] ?? null), "docBaja", array()), "nroDoc", array());
            echo "</cbc:ID>
\t\t<cbc:OrderTypeCode listAgencyName=\"PE:SUNAT\" listName=\"SUNAT:Identificador de Tipo de Documento\" listURI=\"urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01\">";
            // line 24
            echo $this->getAttribute($this->getAttribute(($context["doc"] ?? null), "docBaja", array()), "tipoDoc", array());
            echo "</cbc:OrderTypeCode>
\t</cac:OrderReference>
    ";
        }
        // line 27
        if ($this->getAttribute(($context["doc"] ?? null), "relDoc", array())) {
            // line 28
            echo "<cac:AdditionalDocumentReference>
\t\t<cbc:ID>";
            // line 29
            echo $this->getAttribute($this->getAttribute(($context["doc"] ?? null), "relDoc", array()), "nroDoc", array());
            echo "</cbc:ID>
\t\t<cbc:DocumentTypeCode listAgencyName=\"PE:SUNAT\" listName=\"SUNAT:Identificador de documento relacionado\" listURI=\"urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo21\">";
            // line 30
            echo $this->getAttribute($this->getAttribute(($context["doc"] ?? null), "relDoc", array()), "tipoDoc", array());
            echo "</cbc:DocumentTypeCode>
\t</cac:AdditionalDocumentReference>
    ";
        }
        // line 33
        $context["emp"] = $this->getAttribute(($context["doc"] ?? null), "company", array());
        // line 34
        echo "<cac:DespatchSupplierParty>
\t\t<cbc:CustomerAssignedAccountID schemeID=\"6\">";
        // line 35
        echo $this->getAttribute(($context["emp"] ?? null), "ruc", array());
        echo "</cbc:CustomerAssignedAccountID>
\t\t<cac:Party>
\t\t\t<cac:PartyLegalEntity>
\t\t\t\t<cbc:RegistrationName><![CDATA[";
        // line 38
        echo $this->getAttribute(($context["emp"] ?? null), "razonSocial", array());
        echo "]]></cbc:RegistrationName>
\t\t\t</cac:PartyLegalEntity>
\t\t</cac:Party>
\t</cac:DespatchSupplierParty>
\t<cac:DeliveryCustomerParty>
\t\t<cbc:CustomerAssignedAccountID schemeID=\"";
        // line 43
        echo $this->getAttribute($this->getAttribute(($context["doc"] ?? null), "destinatario", array()), "tipoDoc", array());
        echo "\">";
        echo $this->getAttribute($this->getAttribute(($context["doc"] ?? null), "destinatario", array()), "numDoc", array());
        echo "</cbc:CustomerAssignedAccountID>
\t\t<cac:Party>
\t\t\t<cac:PartyLegalEntity>
\t\t\t\t<cbc:RegistrationName><![CDATA[";
        // line 46
        echo $this->getAttribute($this->getAttribute(($context["doc"] ?? null), "destinatario", array()), "rznSocial", array());
        echo "]]></cbc:RegistrationName>
\t\t\t</cac:PartyLegalEntity>
\t\t</cac:Party>
\t</cac:DeliveryCustomerParty>
    ";
        // line 50
        if ($this->getAttribute(($context["doc"] ?? null), "tercero", array())) {
            // line 51
            echo "<cac:SellerSupplierParty>
\t\t<cbc:CustomerAssignedAccountID schemeID=\"";
            // line 52
            echo $this->getAttribute($this->getAttribute(($context["doc"] ?? null), "tercero", array()), "tipoDoc", array());
            echo "\">";
            echo $this->getAttribute($this->getAttribute(($context["doc"] ?? null), "tercero", array()), "numDoc", array());
            echo "</cbc:CustomerAssignedAccountID>
\t\t<cac:Party>
\t\t\t<cac:PartyLegalEntity>
\t\t\t\t<cbc:RegistrationName><![CDATA[";
            // line 55
            echo $this->getAttribute($this->getAttribute(($context["doc"] ?? null), "tercero", array()), "rznSocial", array());
            echo "]]></cbc:RegistrationName>
\t\t\t</cac:PartyLegalEntity>
\t\t</cac:Party>
\t</cac:SellerSupplierParty>
    ";
        }
        // line 60
        $context["envio"] = $this->getAttribute(($context["doc"] ?? null), "envio", array());
        // line 61
        echo "<cac:Shipment>
\t\t<cbc:ID>1</cbc:ID>
\t\t<cbc:HandlingCode>";
        // line 63
        echo $this->getAttribute(($context["envio"] ?? null), "codTraslado", array());
        echo "</cbc:HandlingCode>
        ";
        // line 64
        if ($this->getAttribute(($context["envio"] ?? null), "desTraslado", array())) {
            // line 65
            echo "<cbc:Information>";
            echo $this->getAttribute(($context["envio"] ?? null), "desTraslado", array());
            echo "</cbc:Information>
\t\t";
        }
        // line 67
        echo "<cbc:GrossWeightMeasure unitCode=\"";
        echo $this->getAttribute(($context["envio"] ?? null), "undPesoTotal", array());
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["envio"] ?? null), "pesoTotal", array()), 3));
        echo "</cbc:GrossWeightMeasure>
        ";
        // line 68
        if ($this->getAttribute(($context["envio"] ?? null), "numBultos", array())) {
            // line 69
            echo "<cbc:TotalTransportHandlingUnitQuantity>";
            echo $this->getAttribute(($context["envio"] ?? null), "numBultos", array());
            echo "</cbc:TotalTransportHandlingUnitQuantity>
\t\t";
        }
        // line 71
        echo "<cbc:SplitConsignmentIndicator>";
        echo (($this->getAttribute(($context["envio"] ?? null), "indTransbordo", array())) ? ("true") : ("false"));
        echo "</cbc:SplitConsignmentIndicator>
\t\t<cac:ShipmentStage>
\t\t\t<cbc:TransportModeCode>";
        // line 73
        echo $this->getAttribute(($context["envio"] ?? null), "modTraslado", array());
        echo "</cbc:TransportModeCode>
\t\t\t<cac:TransitPeriod>
\t\t\t\t<cbc:StartDate>";
        // line 75
        echo twig_date_format_filter($this->env, $this->getAttribute(($context["envio"] ?? null), "fecTraslado", array()), "Y-m-d");
        echo "</cbc:StartDate>
\t\t\t</cac:TransitPeriod>
            ";
        // line 77
        if ($this->getAttribute(($context["envio"] ?? null), "transportista", array())) {
            // line 78
            echo "<cac:CarrierParty>
\t\t\t\t<cac:PartyIdentification>
\t\t\t\t\t<cbc:ID schemeID=\"";
            // line 80
            echo $this->getAttribute($this->getAttribute(($context["envio"] ?? null), "transportista", array()), "tipoDoc", array());
            echo "\">";
            echo $this->getAttribute($this->getAttribute(($context["envio"] ?? null), "transportista", array()), "numDoc", array());
            echo "</cbc:ID>
\t\t\t\t</cac:PartyIdentification>
\t\t\t\t<cac:PartyName>
\t\t\t\t\t<cbc:Name><![CDATA[";
            // line 83
            echo $this->getAttribute($this->getAttribute(($context["envio"] ?? null), "transportista", array()), "rznSocial", array());
            echo "]]></cbc:Name>
\t\t\t\t</cac:PartyName>
\t\t\t</cac:CarrierParty>
\t\t\t<cac:TransportMeans>
\t\t\t\t<cac:RoadTransport>
\t\t\t\t\t<cbc:LicensePlateID>";
            // line 88
            echo $this->getAttribute($this->getAttribute(($context["envio"] ?? null), "transportista", array()), "placa", array());
            echo "</cbc:LicensePlateID>
\t\t\t\t</cac:RoadTransport>
\t\t\t</cac:TransportMeans>
\t\t\t<cac:DriverPerson>
\t\t\t\t<cbc:ID schemeID=\"";
            // line 92
            echo $this->getAttribute($this->getAttribute(($context["envio"] ?? null), "transportista", array()), "choferTipoDoc", array());
            echo "\">";
            echo $this->getAttribute($this->getAttribute(($context["envio"] ?? null), "transportista", array()), "choferDoc", array());
            echo "</cbc:ID>
\t\t\t</cac:DriverPerson>
            ";
        }
        // line 95
        echo "</cac:ShipmentStage>
\t\t<cac:Delivery>
\t\t\t<cac:DeliveryAddress>
\t\t\t\t<cbc:ID>";
        // line 98
        echo $this->getAttribute($this->getAttribute(($context["envio"] ?? null), "llegada", array()), "ubigueo", array());
        echo "</cbc:ID>
\t\t\t\t<cbc:StreetName>";
        // line 99
        echo $this->getAttribute($this->getAttribute(($context["envio"] ?? null), "llegada", array()), "direccion", array());
        echo "</cbc:StreetName>
\t\t\t</cac:DeliveryAddress>
\t\t</cac:Delivery>
        ";
        // line 102
        if ($this->getAttribute(($context["envio"] ?? null), "numContenedor", array())) {
            // line 103
            echo "<cac:TransportHandlingUnit>
\t\t\t<cbc:ID>";
            // line 104
            echo $this->getAttribute(($context["envio"] ?? null), "numContenedor", array());
            echo "</cbc:ID>
\t\t</cac:TransportHandlingUnit>
        ";
        }
        // line 107
        echo "<cac:OriginAddress>
\t\t\t<cbc:ID>";
        // line 108
        echo $this->getAttribute($this->getAttribute(($context["envio"] ?? null), "partida", array()), "ubigueo", array());
        echo "</cbc:ID>
\t\t\t<cbc:StreetName>";
        // line 109
        echo $this->getAttribute($this->getAttribute(($context["envio"] ?? null), "partida", array()), "direccion", array());
        echo "</cbc:StreetName>
\t\t</cac:OriginAddress>
        ";
        // line 111
        if ($this->getAttribute(($context["envio"] ?? null), "codPuerto", array())) {
            // line 112
            echo "<cac:FirstArrivalPortLocation>
\t\t\t<cbc:ID>";
            // line 113
            echo $this->getAttribute(($context["envio"] ?? null), "codPuerto", array());
            echo "</cbc:ID>
\t\t</cac:FirstArrivalPortLocation>
        ";
        }
        // line 116
        echo "</cac:Shipment>
    ";
        // line 117
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["doc"] ?? null), "details", array()));
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
            // line 118
            echo "<cac:DespatchLine>
\t\t<cbc:ID>";
            // line 119
            echo $this->getAttribute($context["loop"], "index", array());
            echo "</cbc:ID>
\t\t<cbc:DeliveredQuantity unitCode=\"";
            // line 120
            echo $this->getAttribute($context["det"], "unidad", array());
            echo "\">";
            echo $this->getAttribute($context["det"], "cantidad", array());
            echo "</cbc:DeliveredQuantity>
\t\t<cac:OrderLineReference>
\t\t\t<cbc:LineID>";
            // line 122
            echo $this->getAttribute($context["loop"], "index", array());
            echo "</cbc:LineID>
\t\t</cac:OrderLineReference>
\t\t<cac:Item>
\t\t\t<cbc:Name><![CDATA[";
            // line 125
            echo $this->getAttribute($context["det"], "descripcion", array());
            echo "]]></cbc:Name>
\t\t\t<cac:SellersItemIdentification>
\t\t\t\t<cbc:ID>";
            // line 127
            echo $this->getAttribute($context["det"], "codigo", array());
            echo "</cbc:ID>
\t\t\t</cac:SellersItemIdentification>
\t\t\t";
            // line 129
            if ($this->getAttribute($context["det"], "codProdSunat", array())) {
                // line 130
                echo "<cac:CommodityClassification>
\t\t\t\t\t<cbc:ItemClassificationCode listID=\"UNSPSC\" listAgencyName=\"GS1 US\" listName=\"Item Classification\">";
                // line 131
                echo $this->getAttribute($context["det"], "codProdSunat", array());
                echo "</cbc:ItemClassificationCode>
\t\t\t\t</cac:CommodityClassification>
\t\t\t";
            }
            // line 134
            echo "</cac:Item>
\t</cac:DespatchLine>
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
        // line 137
        echo "</DespatchAdvice>";
    }

    public function getTemplateName()
    {
        return "despatch.xml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  357 => 137,  341 => 134,  335 => 131,  332 => 130,  330 => 129,  325 => 127,  320 => 125,  314 => 122,  307 => 120,  303 => 119,  300 => 118,  283 => 117,  280 => 116,  274 => 113,  271 => 112,  269 => 111,  264 => 109,  260 => 108,  257 => 107,  251 => 104,  248 => 103,  246 => 102,  240 => 99,  236 => 98,  231 => 95,  223 => 92,  216 => 88,  208 => 83,  200 => 80,  196 => 78,  194 => 77,  189 => 75,  184 => 73,  178 => 71,  172 => 69,  170 => 68,  163 => 67,  157 => 65,  155 => 64,  151 => 63,  147 => 61,  145 => 60,  137 => 55,  129 => 52,  126 => 51,  124 => 50,  117 => 46,  109 => 43,  101 => 38,  95 => 35,  92 => 34,  90 => 33,  84 => 30,  80 => 29,  77 => 28,  75 => 27,  69 => 24,  65 => 23,  62 => 22,  60 => 21,  54 => 19,  52 => 18,  48 => 17,  44 => 16,  40 => 15,  34 => 14,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "despatch.xml.twig", "E:\\Proyecto2018\\SistemaControlV1.1\\vendor\\greenter\\xml\\src\\Xml\\Templates\\despatch.xml.twig");
    }
}
