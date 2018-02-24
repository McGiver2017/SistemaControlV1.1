<?php

/* invoice.xml.twig */
class __TwigTemplate_ad77633487ba6a8b8b3e6fed85a20e04634575e5518a1f6531974058548d89d8 extends Twig_Template
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
        echo "<?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"no\"?>
<Invoice xmlns=\"urn:oasis:names:specification:ubl:schema:xsd:Invoice-2\"
         xmlns:cac=\"urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2\"
         xmlns:cbc=\"urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2\"
         xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\"
         xmlns:ext=\"urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2\"
         xmlns:sac=\"urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1\">
    <ext:UBLExtensions>
        <ext:UBLExtension>
            <ext:ExtensionContent>
                <sac:AdditionalInformation>
                    ";
        // line 12
        if ($this->getAttribute(($context["doc"] ?? null), "mtoDescuentos", array())) {
            // line 13
            echo "<sac:AdditionalMonetaryTotal>
                        <cbc:ID>2005</cbc:ID>
                        <cbc:PayableAmount currencyID=\"";
            // line 15
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoDescuentos", array())));
            echo "</cbc:PayableAmount>
                    </sac:AdditionalMonetaryTotal>
                    ";
        }
        // line 18
        if ($this->getAttribute(($context["doc"] ?? null), "mtoOperGravadas", array())) {
            // line 19
            echo "<sac:AdditionalMonetaryTotal>
                        <cbc:ID>1001</cbc:ID>
                        <cbc:PayableAmount currencyID=\"";
            // line 21
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoOperGravadas", array())));
            echo "</cbc:PayableAmount>
                    </sac:AdditionalMonetaryTotal>
                    ";
        }
        // line 24
        echo "<sac:AdditionalMonetaryTotal>
                        <cbc:ID>1002</cbc:ID>
                        <cbc:PayableAmount currencyID=\"";
        // line 26
        echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoOperInafectas", array())));
        echo "</cbc:PayableAmount>
                    </sac:AdditionalMonetaryTotal>
                    <sac:AdditionalMonetaryTotal>
                        <cbc:ID>1003</cbc:ID>
                        <cbc:PayableAmount currencyID=\"";
        // line 30
        echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoOperExoneradas", array())));
        echo "</cbc:PayableAmount>
                    </sac:AdditionalMonetaryTotal>
                    ";
        // line 32
        if ($this->getAttribute(($context["doc"] ?? null), "mtoOperGratuitas", array())) {
            // line 33
            echo "<sac:AdditionalMonetaryTotal>
                        <cbc:ID>1004</cbc:ID>
                        <cbc:PayableAmount currencyID=\"";
            // line 35
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoOperGratuitas", array())));
            echo "</cbc:PayableAmount>
                    </sac:AdditionalMonetaryTotal>
                    ";
        }
        // line 38
        if ($this->getAttribute(($context["doc"] ?? null), "detraccion", array())) {
            // line 39
            $context["detr"] = $this->getAttribute(($context["doc"] ?? null), "detraccion", array());
            // line 40
            echo "<sac:AdditionalMonetaryTotal>
                        <cbc:ID>2003</cbc:ID>
                        ";
            // line 42
            if ($this->getAttribute(($context["detr"] ?? null), "valueRef", array())) {
                // line 43
                echo "<cbc:ReferenceAmount currencyID=\"PEN\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["detr"] ?? null), "valueRef", array())));
                echo "</cbc:ReferenceAmount>
                        ";
            }
            // line 45
            echo "<cbc:PayableAmount currencyID=\"PEN\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["detr"] ?? null), "mount", array())));
            echo "</cbc:PayableAmount>
                        <cbc:Percent>";
            // line 46
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["detr"] ?? null), "percent", array())));
            echo "</cbc:Percent>
                    </sac:AdditionalMonetaryTotal>
                    ";
        }
        // line 49
        if ($this->getAttribute(($context["doc"] ?? null), "perception", array())) {
            // line 50
            $context["perc"] = $this->getAttribute(($context["doc"] ?? null), "perception", array());
            // line 51
            echo "<sac:AdditionalMonetaryTotal>
                        <cbc:ID schemeID=\"";
            // line 52
            echo $this->getAttribute(($context["perc"] ?? null), "codReg", array());
            echo "\">2001</cbc:ID>
                        <sac:ReferenceAmount currencyID=\"PEN\">";
            // line 53
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["perc"] ?? null), "mtoBase", array())));
            echo "</sac:ReferenceAmount>
                        <cbc:PayableAmount currencyID=\"PEN\">";
            // line 54
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["perc"] ?? null), "mto", array())));
            echo "</cbc:PayableAmount>
                        <sac:TotalAmount currencyID=\"PEN\">";
            // line 55
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["perc"] ?? null), "mtoTotal", array())));
            echo "</sac:TotalAmount>
                    </sac:AdditionalMonetaryTotal>
                    <sac:AdditionalProperty>
                        <cbc:ID>2000</cbc:ID>
                        <cbc:Value>COMPROBANTE DE PERCEPCION</cbc:Value>
                    </sac:AdditionalProperty>
                    ";
        }
        // line 62
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["doc"] ?? null), "legends", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["leg"]) {
            // line 63
            echo "<sac:AdditionalProperty>
                        <cbc:ID>";
            // line 64
            echo $this->getAttribute($context["leg"], "code", array());
            echo "</cbc:ID>
                        <cbc:Value>";
            // line 65
            echo $this->getAttribute($context["leg"], "value", array());
            echo "</cbc:Value>
                    </sac:AdditionalProperty>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['leg'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 68
        if ($this->getAttribute(($context["doc"] ?? null), "guiaEmbebida", array())) {
            // line 69
            $this->loadTemplate("embededDespatch.xml.twig", "invoice.xml.twig", 69)->display(array("desp" => $this->getAttribute(($context["doc"] ?? null), "guiaEmbebida", array())));
            // line 70
            echo "                    ";
        }
        // line 71
        if ($this->getAttribute(($context["doc"] ?? null), "tipoOperacion", array())) {
            // line 72
            echo "<sac:SUNATTransaction>
                        <cbc:ID>";
            // line 73
            echo $this->getAttribute(($context["doc"] ?? null), "tipoOperacion", array());
            echo "</cbc:ID>
                    </sac:SUNATTransaction>
                    ";
        }
        // line 76
        echo "</sac:AdditionalInformation>
            </ext:ExtensionContent>
        </ext:UBLExtension>
        <ext:UBLExtension>
            <ext:ExtensionContent/>
        </ext:UBLExtension>
    </ext:UBLExtensions>
    <cbc:UBLVersionID>2.0</cbc:UBLVersionID>
    <cbc:CustomizationID>1.0</cbc:CustomizationID>
    <cbc:ID>";
        // line 85
        echo $this->getAttribute(($context["doc"] ?? null), "serie", array());
        echo "-";
        echo $this->getAttribute(($context["doc"] ?? null), "correlativo", array());
        echo "</cbc:ID>
    <cbc:IssueDate>";
        // line 86
        echo twig_date_format_filter($this->env, $this->getAttribute(($context["doc"] ?? null), "fechaEmision", array()), "Y-m-d");
        echo "</cbc:IssueDate>
    <cbc:IssueTime>";
        // line 87
        echo twig_date_format_filter($this->env, $this->getAttribute(($context["doc"] ?? null), "fechaEmision", array()), "H:i:s");
        echo "</cbc:IssueTime>
    <cbc:InvoiceTypeCode>";
        // line 88
        echo $this->getAttribute(($context["doc"] ?? null), "tipoDoc", array());
        echo "</cbc:InvoiceTypeCode>
    <cbc:DocumentCurrencyCode>";
        // line 89
        echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
        echo "</cbc:DocumentCurrencyCode>
    ";
        // line 90
        if ($this->getAttribute(($context["doc"] ?? null), "compra", array())) {
            // line 91
            echo "<cac:OrderReference>
        <cbc:ID>";
            // line 92
            echo $this->getAttribute(($context["doc"] ?? null), "compra", array());
            echo "</cbc:ID>
    </cac:OrderReference>
    ";
        }
        // line 95
        if ($this->getAttribute(($context["doc"] ?? null), "guias", array())) {
            // line 96
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["doc"] ?? null), "guias", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["guia"]) {
                // line 97
                echo "<cac:DespatchDocumentReference>
        <cbc:ID>";
                // line 98
                echo $this->getAttribute($context["guia"], "nroDoc", array());
                echo "</cbc:ID>
        <cbc:DocumentTypeCode>";
                // line 99
                echo $this->getAttribute($context["guia"], "tipoDoc", array());
                echo "</cbc:DocumentTypeCode>
    </cac:DespatchDocumentReference>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['guia'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 103
        if ($this->getAttribute(($context["doc"] ?? null), "relDocs", array())) {
            // line 104
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["doc"] ?? null), "relDocs", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["rel"]) {
                // line 105
                echo "<cac:AdditionalDocumentReference>
        <cbc:ID>";
                // line 106
                echo $this->getAttribute($context["rel"], "nroDoc", array());
                echo "</cbc:ID>
        <cbc:DocumentTypeCode>";
                // line 107
                echo $this->getAttribute($context["rel"], "tipoDoc", array());
                echo "</cbc:DocumentTypeCode>
    </cac:AdditionalDocumentReference>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rel'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 111
        $context["emp"] = $this->getAttribute(($context["doc"] ?? null), "company", array());
        // line 112
        echo "<cac:Signature>
        <cbc:ID>";
        // line 113
        echo $this->getAttribute(($context["emp"] ?? null), "ruc", array());
        echo "</cbc:ID>
        <cbc:Note>GREENTER Builder</cbc:Note>
        <cac:SignatoryParty>
            <cac:PartyIdentification>
                <cbc:ID>";
        // line 117
        echo $this->getAttribute(($context["emp"] ?? null), "ruc", array());
        echo "</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name><![CDATA[";
        // line 120
        echo $this->getAttribute(($context["emp"] ?? null), "nombreComercial", array());
        echo "]]></cbc:Name>
            </cac:PartyName>
        </cac:SignatoryParty>
        <cac:DigitalSignatureAttachment>
            <cac:ExternalReference>
                <cbc:URI>#SIGN-GREEN</cbc:URI>
            </cac:ExternalReference>
        </cac:DigitalSignatureAttachment>
    </cac:Signature>
    <cac:AccountingSupplierParty>
        <cbc:CustomerAssignedAccountID>";
        // line 130
        echo $this->getAttribute(($context["emp"] ?? null), "ruc", array());
        echo "</cbc:CustomerAssignedAccountID>
        <cbc:AdditionalAccountID>6</cbc:AdditionalAccountID>
        <cac:Party>
            <cac:PartyName>
                <cbc:Name><![CDATA[";
        // line 134
        echo $this->getAttribute(($context["emp"] ?? null), "nombreComercial", array());
        echo "]]></cbc:Name>
            </cac:PartyName>
            ";
        // line 136
        $context["addr"] = $this->getAttribute(($context["emp"] ?? null), "address", array());
        // line 137
        echo "<cac:PostalAddress>
                <cbc:ID>";
        // line 138
        echo $this->getAttribute(($context["addr"] ?? null), "ubigueo", array());
        echo "</cbc:ID>
                <cbc:StreetName><![CDATA[";
        // line 139
        echo $this->getAttribute(($context["addr"] ?? null), "direccion", array());
        echo "]]></cbc:StreetName>
                <cbc:CityName>";
        // line 140
        echo $this->getAttribute(($context["addr"] ?? null), "departamento", array());
        echo "</cbc:CityName>
                <cbc:CountrySubentity>";
        // line 141
        echo $this->getAttribute(($context["addr"] ?? null), "provincia", array());
        echo "</cbc:CountrySubentity>
                <cbc:District>";
        // line 142
        echo $this->getAttribute(($context["addr"] ?? null), "distrito", array());
        echo "</cbc:District>
                <cac:Country>
                    <cbc:IdentificationCode>";
        // line 144
        echo $this->getAttribute(($context["addr"] ?? null), "codigoPais", array());
        echo "</cbc:IdentificationCode>
                </cac:Country>
            </cac:PostalAddress>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[";
        // line 148
        echo $this->getAttribute(($context["emp"] ?? null), "razonSocial", array());
        echo "]]></cbc:RegistrationName>
            </cac:PartyLegalEntity>
        </cac:Party>
    </cac:AccountingSupplierParty>
    ";
        // line 152
        $context["client"] = $this->getAttribute(($context["doc"] ?? null), "client", array());
        // line 153
        echo "<cac:AccountingCustomerParty>
        <cbc:CustomerAssignedAccountID>";
        // line 154
        echo $this->getAttribute(($context["client"] ?? null), "numDoc", array());
        echo "</cbc:CustomerAssignedAccountID>
        <cbc:AdditionalAccountID>";
        // line 155
        echo $this->getAttribute(($context["client"] ?? null), "tipoDoc", array());
        echo "</cbc:AdditionalAccountID>
        <cac:Party>
            ";
        // line 157
        if ($this->getAttribute(($context["client"] ?? null), "address", array())) {
            // line 158
            $context["addr"] = $this->getAttribute(($context["client"] ?? null), "address", array());
            // line 159
            echo "<cac:PostalAddress>
                    <cbc:ID>";
            // line 160
            echo $this->getAttribute(($context["addr"] ?? null), "ubigueo", array());
            echo "</cbc:ID>
                    <cbc:StreetName><![CDATA[";
            // line 161
            echo $this->getAttribute(($context["addr"] ?? null), "direccion", array());
            echo "]]></cbc:StreetName>
                    <cac:Country>
                        <cbc:IdentificationCode>";
            // line 163
            echo $this->getAttribute(($context["addr"] ?? null), "codigoPais", array());
            echo "</cbc:IdentificationCode>
                    </cac:Country>
                </cac:PostalAddress>
            ";
        }
        // line 167
        echo "<cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[";
        // line 168
        echo $this->getAttribute(($context["client"] ?? null), "rznSocial", array());
        echo "]]></cbc:RegistrationName>
            </cac:PartyLegalEntity>
        </cac:Party>
    </cac:AccountingCustomerParty>
    ";
        // line 172
        if ($this->getAttribute(($context["doc"] ?? null), "fecVencimiento", array())) {
            // line 173
            echo "<cac:PaymentMeans>
        <cbc:PaymentMeansCode>1</cbc:PaymentMeansCode>
        <cbc:PaymentDueDate>";
            // line 175
            echo twig_date_format_filter($this->env, $this->getAttribute(($context["doc"] ?? null), "fecVencimiento", array()), "Y-m-d");
            echo "</cbc:PaymentDueDate>
    </cac:PaymentMeans>
    ";
        }
        // line 178
        if ($this->getAttribute(($context["doc"] ?? null), "anticipos", array())) {
            // line 179
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["doc"] ?? null), "anticipos", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["ant"]) {
                // line 180
                echo "<cac:PrepaidPayment>
        <cbc:ID schemeID=\"";
                // line 181
                echo $this->getAttribute($context["ant"], "tipoDocRel", array());
                echo "\">";
                echo $this->getAttribute($context["ant"], "nroDocRel", array());
                echo "</cbc:ID>
        <cbc:PaidAmount currencyID=\"";
                // line 182
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["ant"], "total", array())));
                echo "</cbc:PaidAmount>
        <cbc:InstructionID schemeID=\"6\">";
                // line 183
                echo $this->getAttribute(($context["emp"] ?? null), "ruc", array());
                echo "</cbc:InstructionID>
    </cac:PrepaidPayment>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ant'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 187
        if ($this->getAttribute(($context["doc"] ?? null), "mtoISC", array())) {
            // line 188
            $context["iscT"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoISC", array())));
            // line 189
            echo "<cac:TaxTotal>
        <cbc:TaxAmount currencyID=\"";
            // line 190
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo ($context["iscT"] ?? null);
            echo "</cbc:TaxAmount>
        <cac:TaxSubtotal>
            <cbc:TaxAmount currencyID=\"";
            // line 192
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo ($context["iscT"] ?? null);
            echo "</cbc:TaxAmount>
            <cac:TaxCategory>
                <cac:TaxScheme>
                    <cbc:ID>2000</cbc:ID>
                    <cbc:Name>ISC</cbc:Name>
                    <cbc:TaxTypeCode>EXC</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
    </cac:TaxTotal>
    ";
        }
        // line 203
        if ($this->getAttribute(($context["doc"] ?? null), "mtoIGV", array())) {
            // line 204
            $context["igvT"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoIGV", array())));
            // line 205
            echo "<cac:TaxTotal>
        <cbc:TaxAmount currencyID=\"";
            // line 206
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo ($context["igvT"] ?? null);
            echo "</cbc:TaxAmount>
        <cac:TaxSubtotal>
            <cbc:TaxAmount currencyID=\"";
            // line 208
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo ($context["igvT"] ?? null);
            echo "</cbc:TaxAmount>
            <cac:TaxCategory>
                <cac:TaxScheme>
                    <cbc:ID>1000</cbc:ID>
                    <cbc:Name>IGV</cbc:Name>
                    <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
    </cac:TaxTotal>
    ";
        }
        // line 219
        if ($this->getAttribute(($context["doc"] ?? null), "sumOtrosCargos", array())) {
            // line 220
            $context["othT"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "sumOtrosCargos", array())));
            // line 221
            echo "<cac:TaxTotal>
        <cbc:TaxAmount currencyID=\"";
            // line 222
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo ($context["othT"] ?? null);
            echo "</cbc:TaxAmount>
        <cac:TaxSubtotal>
            <cbc:TaxAmount currencyID=\"";
            // line 224
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo ($context["othT"] ?? null);
            echo "</cbc:TaxAmount>
            <cac:TaxCategory>
                <cac:TaxScheme>
                    <cbc:ID>9999</cbc:ID>
                    <cbc:Name>OTROS</cbc:Name>
                    <cbc:TaxTypeCode>>OTH</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
    </cac:TaxTotal>
    ";
        }
        // line 235
        echo "<cac:LegalMonetaryTotal>
        <cbc:AllowanceTotalAmount currencyID=\"";
        // line 236
        echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array((($this->getAttribute(($context["doc"] ?? null), "sumDsctoGlobal", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["doc"] ?? null), "sumDsctoGlobal", array()), 0)) : (0))));
        echo "</cbc:AllowanceTotalAmount>
        <cbc:ChargeTotalAmount currencyID=\"";
        // line 237
        echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array((($this->getAttribute(($context["doc"] ?? null), "mtoOtrosTributos", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["doc"] ?? null), "mtoOtrosTributos", array()), 0)) : (0))));
        echo "</cbc:ChargeTotalAmount>
        ";
        // line 238
        if ($this->getAttribute(($context["doc"] ?? null), "totalAnticipos", array())) {
            echo "<cbc:PrepaidAmount currencyID=\"";
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "totalAnticipos", array())));
            echo "</cbc:PrepaidAmount>";
        }
        // line 239
        echo "<cbc:PayableAmount currencyID=\"";
        echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoImpVenta", array())));
        echo "</cbc:PayableAmount>
    </cac:LegalMonetaryTotal>
    ";
        // line 241
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
        foreach ($context['_seq'] as $context["_key"] => $context["detail"]) {
            // line 242
            echo "<cac:InvoiceLine>
        <cbc:ID>";
            // line 243
            echo $this->getAttribute($context["loop"], "index", array());
            echo "</cbc:ID>
        <cbc:InvoicedQuantity unitCode=\"";
            // line 244
            echo $this->getAttribute($context["detail"], "unidad", array());
            echo "\">";
            echo $this->getAttribute($context["detail"], "cantidad", array());
            echo "</cbc:InvoicedQuantity>
        <cbc:LineExtensionAmount currencyID=\"";
            // line 245
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "mtoValorVenta", array())));
            echo "</cbc:LineExtensionAmount>
        ";
            // line 246
            if (($this->getAttribute($context["detail"], "mtoPrecioUnitario", array()) > 0)) {
                // line 247
                echo "<cac:PricingReference>
            <cac:AlternativeConditionPrice>
                <cbc:PriceAmount currencyID=\"";
                // line 249
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "mtoPrecioUnitario", array())));
                echo "</cbc:PriceAmount>
                <cbc:PriceTypeCode>01</cbc:PriceTypeCode>
            </cac:AlternativeConditionPrice>
        </cac:PricingReference>
        ";
            } else {
                // line 254
                echo "<cac:PricingReference>
            <cac:AlternativeConditionPrice>
                <cbc:PriceAmount currencyID=\"";
                // line 256
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "mtoValorGratuito", array())));
                echo "</cbc:PriceAmount>
                <cbc:PriceTypeCode>02</cbc:PriceTypeCode>
            </cac:AlternativeConditionPrice>
        </cac:PricingReference>
        ";
            }
            // line 261
            if ($this->getAttribute($context["detail"], "descuento", array())) {
                // line 262
                echo "<cac:AllowanceCharge>
            <cbc:ChargeIndicator>false</cbc:ChargeIndicator>
            <cbc:AllowanceChargeReasonCode>00</cbc:AllowanceChargeReasonCode>
            <cbc:Amount currencyID=\"";
                // line 265
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "descuento", array())));
                echo "</cbc:Amount>
        </cac:AllowanceCharge>
        ";
            }
            // line 268
            if ($this->getAttribute($context["detail"], "isc", array())) {
                // line 269
                $context["isc"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "isc", array())));
                // line 270
                echo "<cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
                // line 271
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo ($context["isc"] ?? null);
                echo "</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 273
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo ($context["isc"] ?? null);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cbc:TierRange>";
                // line 275
                echo $this->getAttribute($context["detail"], "tipSisIsc", array());
                echo "</cbc:TierRange>
                    <cac:TaxScheme>
                        <cbc:ID>2000</cbc:ID>
                        <cbc:Name>ISC</cbc:Name>
                        <cbc:TaxTypeCode>EXC</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        ";
            }
            // line 285
            if ($this->getAttribute($context["detail"], "igv", array())) {
                // line 286
                $context["igv"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "igv", array())));
                // line 287
                echo "<cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
                // line 288
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo ($context["igv"] ?? null);
                echo "</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 290
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo ($context["igv"] ?? null);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cbc:TaxExemptionReasonCode>";
                // line 292
                echo $this->getAttribute($context["detail"], "tipAfeIgv", array());
                echo "</cbc:TaxExemptionReasonCode>
                    <cac:TaxScheme>
                        <cbc:ID>1000</cbc:ID>
                        <cbc:Name>IGV</cbc:Name>
                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        ";
            }
            // line 302
            echo "<cac:Item>
            <cbc:Description><![CDATA[";
            // line 303
            echo $this->getAttribute($context["detail"], "descripcion", array());
            echo "]]></cbc:Description>
            <cac:SellersItemIdentification>
                <cbc:ID>";
            // line 305
            echo $this->getAttribute($context["detail"], "codProducto", array());
            echo "</cbc:ID>
            </cac:SellersItemIdentification>
            ";
            // line 307
            if ($this->getAttribute($context["detail"], "codProdSunat", array())) {
                // line 308
                echo "<cac:CommodityClassification>
                <cbc:ItemClassificationCode listID=\"UNSPSC\" listAgencyName=\"GS1 US\" listName=\"Item Classification\">";
                // line 309
                echo $this->getAttribute($context["detail"], "codProdSunat", array());
                echo "</cbc:ItemClassificationCode>
            </cac:CommodityClassification>
            ";
            }
            // line 312
            echo "</cac:Item>
        <cac:Price>
            <cbc:PriceAmount currencyID=\"";
            // line 314
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "mtoValorUnitario", array())));
            echo "</cbc:PriceAmount>
        </cac:Price>
    </cac:InvoiceLine>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['detail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 318
        echo "</Invoice>";
    }

    public function getTemplateName()
    {
        return "invoice.xml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  769 => 318,  749 => 314,  745 => 312,  739 => 309,  736 => 308,  734 => 307,  729 => 305,  724 => 303,  721 => 302,  708 => 292,  701 => 290,  694 => 288,  691 => 287,  689 => 286,  687 => 285,  674 => 275,  667 => 273,  660 => 271,  657 => 270,  655 => 269,  653 => 268,  645 => 265,  640 => 262,  638 => 261,  628 => 256,  624 => 254,  614 => 249,  610 => 247,  608 => 246,  602 => 245,  596 => 244,  592 => 243,  589 => 242,  572 => 241,  564 => 239,  556 => 238,  550 => 237,  544 => 236,  541 => 235,  525 => 224,  518 => 222,  515 => 221,  513 => 220,  511 => 219,  495 => 208,  488 => 206,  485 => 205,  483 => 204,  481 => 203,  465 => 192,  458 => 190,  455 => 189,  453 => 188,  451 => 187,  441 => 183,  435 => 182,  429 => 181,  426 => 180,  422 => 179,  420 => 178,  414 => 175,  410 => 173,  408 => 172,  401 => 168,  398 => 167,  391 => 163,  386 => 161,  382 => 160,  379 => 159,  377 => 158,  375 => 157,  370 => 155,  366 => 154,  363 => 153,  361 => 152,  354 => 148,  347 => 144,  342 => 142,  338 => 141,  334 => 140,  330 => 139,  326 => 138,  323 => 137,  321 => 136,  316 => 134,  309 => 130,  296 => 120,  290 => 117,  283 => 113,  280 => 112,  278 => 111,  268 => 107,  264 => 106,  261 => 105,  257 => 104,  255 => 103,  245 => 99,  241 => 98,  238 => 97,  234 => 96,  232 => 95,  226 => 92,  223 => 91,  221 => 90,  217 => 89,  213 => 88,  209 => 87,  205 => 86,  199 => 85,  188 => 76,  182 => 73,  179 => 72,  177 => 71,  174 => 70,  172 => 69,  170 => 68,  161 => 65,  157 => 64,  154 => 63,  150 => 62,  140 => 55,  136 => 54,  132 => 53,  128 => 52,  125 => 51,  123 => 50,  121 => 49,  115 => 46,  110 => 45,  104 => 43,  102 => 42,  98 => 40,  96 => 39,  94 => 38,  86 => 35,  82 => 33,  80 => 32,  73 => 30,  64 => 26,  60 => 24,  52 => 21,  48 => 19,  46 => 18,  38 => 15,  34 => 13,  32 => 12,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "invoice.xml.twig", "E:\\Proyecto2018\\SistemaControlV1.1\\vendor\\greenter\\xml\\src\\Xml\\Templates\\invoice.xml.twig");
    }
}
