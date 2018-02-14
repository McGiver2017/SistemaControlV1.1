<?php

/* invoice.xml.twig */
class __TwigTemplate_a47f5b9215fc3cd2e608b8741227304f4907d8abf51c4888125389e2e010b26d extends Twig_Template
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
        if ($this->getAttribute(($context["doc"] ?? null), "mtoOperInafectas", array())) {
            // line 25
            echo "<sac:AdditionalMonetaryTotal>
                        <cbc:ID>1002</cbc:ID>
                        <cbc:PayableAmount currencyID=\"";
            // line 27
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoOperInafectas", array())));
            echo "</cbc:PayableAmount>
                    </sac:AdditionalMonetaryTotal>
                    ";
        }
        // line 30
        if ($this->getAttribute(($context["doc"] ?? null), "mtoOperExoneradas", array())) {
            // line 31
            echo "<sac:AdditionalMonetaryTotal>
                        <cbc:ID>1003</cbc:ID>
                        <cbc:PayableAmount currencyID=\"";
            // line 33
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoOperExoneradas", array())));
            echo "</cbc:PayableAmount>
                    </sac:AdditionalMonetaryTotal>
                    ";
        }
        // line 36
        if ($this->getAttribute(($context["doc"] ?? null), "mtoOperGratuitas", array())) {
            // line 37
            echo "<sac:AdditionalMonetaryTotal>
                        <cbc:ID>1004</cbc:ID>
                        <cbc:PayableAmount currencyID=\"";
            // line 39
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoOperGratuitas", array())));
            echo "</cbc:PayableAmount>
                    </sac:AdditionalMonetaryTotal>
                    ";
        }
        // line 42
        if ($this->getAttribute(($context["doc"] ?? null), "detraccion", array())) {
            // line 43
            $context["detr"] = $this->getAttribute(($context["doc"] ?? null), "detraccion", array());
            // line 44
            echo "<sac:AdditionalMonetaryTotal>
                        <cbc:ID>2003</cbc:ID>
                        ";
            // line 46
            if ($this->getAttribute(($context["detr"] ?? null), "valueRef", array())) {
                // line 47
                echo "<cbc:ReferenceAmount currencyID=\"PEN\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["detr"] ?? null), "valueRef", array())));
                echo "</cbc:ReferenceAmount>
                        ";
            }
            // line 49
            echo "<cbc:PayableAmount currencyID=\"PEN\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["detr"] ?? null), "mount", array())));
            echo "</cbc:PayableAmount>
                        <cbc:Percent>";
            // line 50
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["detr"] ?? null), "percent", array())));
            echo "</cbc:Percent>
                    </sac:AdditionalMonetaryTotal>
                    ";
        }
        // line 53
        if ($this->getAttribute(($context["doc"] ?? null), "perception", array())) {
            // line 54
            $context["perc"] = $this->getAttribute(($context["doc"] ?? null), "perception", array());
            // line 55
            echo "<sac:AdditionalMonetaryTotal>
                        <cbc:ID schemeID=\"";
            // line 56
            echo $this->getAttribute(($context["perc"] ?? null), "codReg", array());
            echo "\">2001</cbc:ID>
                        <sac:ReferenceAmount currencyID=\"PEN\">";
            // line 57
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["perc"] ?? null), "mtoBase", array())));
            echo "</sac:ReferenceAmount>
                        <cbc:PayableAmount currencyID=\"PEN\">";
            // line 58
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["perc"] ?? null), "mto", array())));
            echo "</cbc:PayableAmount>
                        <sac:TotalAmount currencyID=\"PEN\">";
            // line 59
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["perc"] ?? null), "mtoTotal", array())));
            echo "</sac:TotalAmount>
                    </sac:AdditionalMonetaryTotal>
                    <sac:AdditionalProperty>
                        <cbc:ID>2000</cbc:ID>
                        <cbc:Value>COMPROBANTE DE PERCEPCION</cbc:Value>
                    </sac:AdditionalProperty>
                    ";
        }
        // line 66
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["doc"] ?? null), "legends", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["leg"]) {
            // line 67
            echo "<sac:AdditionalProperty>
                        <cbc:ID>";
            // line 68
            echo $this->getAttribute($context["leg"], "code", array());
            echo "</cbc:ID>
                        <cbc:Value>";
            // line 69
            echo $this->getAttribute($context["leg"], "value", array());
            echo "</cbc:Value>
                    </sac:AdditionalProperty>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['leg'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 72
        if ($this->getAttribute(($context["doc"] ?? null), "guiaEmbebida", array())) {
            // line 73
            $this->loadTemplate("embededDespatch.xml.twig", "invoice.xml.twig", 73)->display(array("desp" => $this->getAttribute(($context["doc"] ?? null), "guiaEmbebida", array())));
            // line 74
            echo "                    ";
        }
        // line 75
        if ($this->getAttribute(($context["doc"] ?? null), "tipoOperacion", array())) {
            // line 76
            echo "<sac:SUNATTransaction>
                        <cbc:ID>";
            // line 77
            echo $this->getAttribute(($context["doc"] ?? null), "tipoOperacion", array());
            echo "</cbc:ID>
                    </sac:SUNATTransaction>
                    ";
        }
        // line 80
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
        // line 89
        echo $this->getAttribute(($context["doc"] ?? null), "serie", array());
        echo "-";
        echo $this->getAttribute(($context["doc"] ?? null), "correlativo", array());
        echo "</cbc:ID>
    <cbc:IssueDate>";
        // line 90
        echo twig_date_format_filter($this->env, $this->getAttribute(($context["doc"] ?? null), "fechaEmision", array()), "Y-m-d");
        echo "</cbc:IssueDate>
    <cbc:IssueTime>";
        // line 91
        echo twig_date_format_filter($this->env, $this->getAttribute(($context["doc"] ?? null), "fechaEmision", array()), "H:i:s");
        echo "</cbc:IssueTime>
    <cbc:InvoiceTypeCode>";
        // line 92
        echo $this->getAttribute(($context["doc"] ?? null), "tipoDoc", array());
        echo "</cbc:InvoiceTypeCode>
    <cbc:DocumentCurrencyCode>";
        // line 93
        echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
        echo "</cbc:DocumentCurrencyCode>
    ";
        // line 94
        if ($this->getAttribute(($context["doc"] ?? null), "compra", array())) {
            // line 95
            echo "<cac:OrderReference>
        <cbc:ID>";
            // line 96
            echo $this->getAttribute(($context["doc"] ?? null), "compra", array());
            echo "</cbc:ID>
    </cac:OrderReference>
    ";
        }
        // line 99
        if ($this->getAttribute(($context["doc"] ?? null), "guias", array())) {
            // line 100
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["doc"] ?? null), "guias", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["guia"]) {
                // line 101
                echo "<cac:DespatchDocumentReference>
        <cbc:ID>";
                // line 102
                echo $this->getAttribute($context["guia"], "nroDoc", array());
                echo "</cbc:ID>
        <cbc:DocumentTypeCode>";
                // line 103
                echo $this->getAttribute($context["guia"], "tipoDoc", array());
                echo "</cbc:DocumentTypeCode>
    </cac:DespatchDocumentReference>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['guia'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 107
        if ($this->getAttribute(($context["doc"] ?? null), "relDocs", array())) {
            // line 108
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["doc"] ?? null), "relDocs", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["rel"]) {
                // line 109
                echo "<cac:AdditionalDocumentReference>
        <cbc:ID>";
                // line 110
                echo $this->getAttribute($context["rel"], "nroDoc", array());
                echo "</cbc:ID>
        <cbc:DocumentTypeCode>";
                // line 111
                echo $this->getAttribute($context["rel"], "tipoDoc", array());
                echo "</cbc:DocumentTypeCode>
    </cac:AdditionalDocumentReference>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rel'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 115
        $context["emp"] = $this->getAttribute(($context["doc"] ?? null), "company", array());
        // line 116
        echo "<cac:Signature>
        <cbc:ID>";
        // line 117
        echo $this->getAttribute(($context["emp"] ?? null), "ruc", array());
        echo "</cbc:ID>
        <cbc:Note>GREENTER Builder</cbc:Note>
        <cac:SignatoryParty>
            <cac:PartyIdentification>
                <cbc:ID>";
        // line 121
        echo $this->getAttribute(($context["emp"] ?? null), "ruc", array());
        echo "</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name><![CDATA[";
        // line 124
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
        // line 134
        echo $this->getAttribute(($context["emp"] ?? null), "ruc", array());
        echo "</cbc:CustomerAssignedAccountID>
        <cbc:AdditionalAccountID>6</cbc:AdditionalAccountID>
        <cac:Party>
            <cac:PartyName>
                <cbc:Name><![CDATA[";
        // line 138
        echo $this->getAttribute(($context["emp"] ?? null), "nombreComercial", array());
        echo "]]></cbc:Name>
            </cac:PartyName>
            ";
        // line 140
        $context["addr"] = $this->getAttribute(($context["emp"] ?? null), "address", array());
        // line 141
        echo "<cac:PostalAddress>
                <cbc:ID>";
        // line 142
        echo $this->getAttribute(($context["addr"] ?? null), "ubigueo", array());
        echo "</cbc:ID>
                <cbc:StreetName><![CDATA[";
        // line 143
        echo $this->getAttribute(($context["addr"] ?? null), "direccion", array());
        echo "]]></cbc:StreetName>
                <cbc:CityName>";
        // line 144
        echo $this->getAttribute(($context["addr"] ?? null), "departamento", array());
        echo "</cbc:CityName>
                <cbc:CountrySubentity>";
        // line 145
        echo $this->getAttribute(($context["addr"] ?? null), "provincia", array());
        echo "</cbc:CountrySubentity>
                <cbc:District>";
        // line 146
        echo $this->getAttribute(($context["addr"] ?? null), "distrito", array());
        echo "</cbc:District>
                <cac:Country>
                    <cbc:IdentificationCode>";
        // line 148
        echo $this->getAttribute(($context["addr"] ?? null), "codigoPais", array());
        echo "</cbc:IdentificationCode>
                </cac:Country>
            </cac:PostalAddress>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[";
        // line 152
        echo $this->getAttribute(($context["emp"] ?? null), "razonSocial", array());
        echo "]]></cbc:RegistrationName>
            </cac:PartyLegalEntity>
        </cac:Party>
    </cac:AccountingSupplierParty>
    ";
        // line 156
        $context["client"] = $this->getAttribute(($context["doc"] ?? null), "client", array());
        // line 157
        echo "<cac:AccountingCustomerParty>
        <cbc:CustomerAssignedAccountID>";
        // line 158
        echo $this->getAttribute(($context["client"] ?? null), "numDoc", array());
        echo "</cbc:CustomerAssignedAccountID>
        <cbc:AdditionalAccountID>";
        // line 159
        echo $this->getAttribute(($context["client"] ?? null), "tipoDoc", array());
        echo "</cbc:AdditionalAccountID>
        <cac:Party>
            ";
        // line 161
        if ($this->getAttribute(($context["client"] ?? null), "address", array())) {
            // line 162
            $context["addr"] = $this->getAttribute(($context["client"] ?? null), "address", array());
            // line 163
            echo "<cac:PostalAddress>
                    <cbc:ID>";
            // line 164
            echo $this->getAttribute(($context["addr"] ?? null), "ubigueo", array());
            echo "</cbc:ID>
                    <cbc:StreetName><![CDATA[";
            // line 165
            echo $this->getAttribute(($context["addr"] ?? null), "direccion", array());
            echo "]]></cbc:StreetName>
                    <cac:Country>
                        <cbc:IdentificationCode>";
            // line 167
            echo $this->getAttribute(($context["addr"] ?? null), "codigoPais", array());
            echo "</cbc:IdentificationCode>
                    </cac:Country>
                </cac:PostalAddress>
            ";
        }
        // line 171
        echo "<cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[";
        // line 172
        echo $this->getAttribute(($context["client"] ?? null), "rznSocial", array());
        echo "]]></cbc:RegistrationName>
            </cac:PartyLegalEntity>
        </cac:Party>
    </cac:AccountingCustomerParty>
    ";
        // line 176
        if ($this->getAttribute(($context["doc"] ?? null), "fecVencimiento", array())) {
            // line 177
            echo "<cac:PaymentMeans>
        <cbc:PaymentMeansCode>1</cbc:PaymentMeansCode>
        <cbc:PaymentDueDate>";
            // line 179
            echo twig_date_format_filter($this->env, $this->getAttribute(($context["doc"] ?? null), "fecVencimiento", array()), "Y-m-d");
            echo "</cbc:PaymentDueDate>
    </cac:PaymentMeans>
    ";
        }
        // line 182
        if ($this->getAttribute(($context["doc"] ?? null), "anticipos", array())) {
            // line 183
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["doc"] ?? null), "anticipos", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["ant"]) {
                // line 184
                echo "<cac:PrepaidPayment>
        <cbc:ID schemeID=\"";
                // line 185
                echo $this->getAttribute($context["ant"], "tipoDocRel", array());
                echo "\">";
                echo $this->getAttribute($context["ant"], "nroDocRel", array());
                echo "</cbc:ID>
        <cbc:PaidAmount currencyID=\"";
                // line 186
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["ant"], "total", array())));
                echo "</cbc:PaidAmount>
        <cbc:InstructionID schemeID=\"6\">";
                // line 187
                echo $this->getAttribute(($context["emp"] ?? null), "ruc", array());
                echo "</cbc:InstructionID>
    </cac:PrepaidPayment>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ant'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 191
        if ($this->getAttribute(($context["doc"] ?? null), "mtoISC", array())) {
            // line 192
            $context["iscT"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoISC", array())));
            // line 193
            echo "<cac:TaxTotal>
        <cbc:TaxAmount currencyID=\"";
            // line 194
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo ($context["iscT"] ?? null);
            echo "</cbc:TaxAmount>
        <cac:TaxSubtotal>
            <cbc:TaxAmount currencyID=\"";
            // line 196
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
        // line 207
        if ($this->getAttribute(($context["doc"] ?? null), "mtoIGV", array())) {
            // line 208
            $context["igvT"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoIGV", array())));
            // line 209
            echo "<cac:TaxTotal>
        <cbc:TaxAmount currencyID=\"";
            // line 210
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo ($context["igvT"] ?? null);
            echo "</cbc:TaxAmount>
        <cac:TaxSubtotal>
            <cbc:TaxAmount currencyID=\"";
            // line 212
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
        // line 223
        if ($this->getAttribute(($context["doc"] ?? null), "sumOtrosCargos", array())) {
            // line 224
            $context["othT"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "sumOtrosCargos", array())));
            // line 225
            echo "<cac:TaxTotal>
        <cbc:TaxAmount currencyID=\"";
            // line 226
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo ($context["othT"] ?? null);
            echo "</cbc:TaxAmount>
        <cac:TaxSubtotal>
            <cbc:TaxAmount currencyID=\"";
            // line 228
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
        // line 239
        echo "<cac:LegalMonetaryTotal>
        <cbc:AllowanceTotalAmount currencyID=\"";
        // line 240
        echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array((($this->getAttribute(($context["doc"] ?? null), "sumDsctoGlobal", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["doc"] ?? null), "sumDsctoGlobal", array()), 0)) : (0))));
        echo "</cbc:AllowanceTotalAmount>
        <cbc:ChargeTotalAmount currencyID=\"";
        // line 241
        echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array((($this->getAttribute(($context["doc"] ?? null), "mtoOtrosTributos", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["doc"] ?? null), "mtoOtrosTributos", array()), 0)) : (0))));
        echo "</cbc:ChargeTotalAmount>
        ";
        // line 242
        if ($this->getAttribute(($context["doc"] ?? null), "totalAnticipos", array())) {
            echo "<cbc:PrepaidAmount currencyID=\"";
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "totalAnticipos", array())));
            echo "</cbc:PrepaidAmount>";
        }
        // line 243
        echo "<cbc:PayableAmount currencyID=\"";
        echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoImpVenta", array())));
        echo "</cbc:PayableAmount>
    </cac:LegalMonetaryTotal>
    ";
        // line 245
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
            // line 246
            echo "<cac:InvoiceLine>
        <cbc:ID>";
            // line 247
            echo $this->getAttribute($context["loop"], "index", array());
            echo "</cbc:ID>
        <cbc:InvoicedQuantity unitCode=\"";
            // line 248
            echo $this->getAttribute($context["detail"], "unidad", array());
            echo "\">";
            echo $this->getAttribute($context["detail"], "cantidad", array());
            echo "</cbc:InvoicedQuantity>
        <cbc:LineExtensionAmount currencyID=\"";
            // line 249
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "mtoValorVenta", array())));
            echo "</cbc:LineExtensionAmount>
        ";
            // line 250
            if (($this->getAttribute($context["detail"], "mtoPrecioUnitario", array()) > 0)) {
                // line 251
                echo "<cac:PricingReference>
            <cac:AlternativeConditionPrice>
                <cbc:PriceAmount currencyID=\"";
                // line 253
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "mtoPrecioUnitario", array())));
                echo "</cbc:PriceAmount>
                <cbc:PriceTypeCode>01</cbc:PriceTypeCode>
            </cac:AlternativeConditionPrice>
        </cac:PricingReference>
        ";
            } else {
                // line 258
                echo "<cac:PricingReference>
            <cac:AlternativeConditionPrice>
                <cbc:PriceAmount currencyID=\"";
                // line 260
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "mtoValorGratuito", array())));
                echo "</cbc:PriceAmount>
                <cbc:PriceTypeCode>02</cbc:PriceTypeCode>
            </cac:AlternativeConditionPrice>
        </cac:PricingReference>
        ";
            }
            // line 265
            if ($this->getAttribute($context["detail"], "descuento", array())) {
                // line 266
                echo "<cac:AllowanceCharge>
            <cbc:ChargeIndicator>false</cbc:ChargeIndicator>
            <cbc:AllowanceChargeReasonCode>00</cbc:AllowanceChargeReasonCode>
            <cbc:Amount currencyID=\"";
                // line 269
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "descuento", array())));
                echo "</cbc:Amount>
        </cac:AllowanceCharge>
        ";
            }
            // line 272
            if ($this->getAttribute($context["detail"], "isc", array())) {
                // line 273
                $context["isc"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "isc", array())));
                // line 274
                echo "<cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
                // line 275
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo ($context["isc"] ?? null);
                echo "</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 277
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo ($context["isc"] ?? null);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cbc:TierRange>";
                // line 279
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
            // line 289
            if ($this->getAttribute($context["detail"], "igv", array())) {
                // line 290
                $context["igv"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "igv", array())));
                // line 291
                echo "<cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
                // line 292
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo ($context["igv"] ?? null);
                echo "</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 294
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo ($context["igv"] ?? null);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cbc:TaxExemptionReasonCode>";
                // line 296
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
            // line 306
            echo "<cac:Item>
            <cbc:Description><![CDATA[";
            // line 307
            echo $this->getAttribute($context["detail"], "descripcion", array());
            echo "]]></cbc:Description>
            <cac:SellersItemIdentification>
                <cbc:ID>";
            // line 309
            echo $this->getAttribute($context["detail"], "codProducto", array());
            echo "</cbc:ID>
            </cac:SellersItemIdentification>
            ";
            // line 311
            if ($this->getAttribute($context["detail"], "codProdSunat", array())) {
                // line 312
                echo "<cac:CommodityClassification>
                <cbc:ItemClassificationCode listID=\"UNSPSC\" listAgencyName=\"GS1 US\" listName=\"Item Classification\">";
                // line 313
                echo $this->getAttribute($context["detail"], "codProdSunat", array());
                echo "</cbc:ItemClassificationCode>
            </cac:CommodityClassification>
            ";
            }
            // line 316
            echo "</cac:Item>
        <cac:Price>
            <cbc:PriceAmount currencyID=\"";
            // line 318
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
        // line 322
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
        return array (  777 => 322,  757 => 318,  753 => 316,  747 => 313,  744 => 312,  742 => 311,  737 => 309,  732 => 307,  729 => 306,  716 => 296,  709 => 294,  702 => 292,  699 => 291,  697 => 290,  695 => 289,  682 => 279,  675 => 277,  668 => 275,  665 => 274,  663 => 273,  661 => 272,  653 => 269,  648 => 266,  646 => 265,  636 => 260,  632 => 258,  622 => 253,  618 => 251,  616 => 250,  610 => 249,  604 => 248,  600 => 247,  597 => 246,  580 => 245,  572 => 243,  564 => 242,  558 => 241,  552 => 240,  549 => 239,  533 => 228,  526 => 226,  523 => 225,  521 => 224,  519 => 223,  503 => 212,  496 => 210,  493 => 209,  491 => 208,  489 => 207,  473 => 196,  466 => 194,  463 => 193,  461 => 192,  459 => 191,  449 => 187,  443 => 186,  437 => 185,  434 => 184,  430 => 183,  428 => 182,  422 => 179,  418 => 177,  416 => 176,  409 => 172,  406 => 171,  399 => 167,  394 => 165,  390 => 164,  387 => 163,  385 => 162,  383 => 161,  378 => 159,  374 => 158,  371 => 157,  369 => 156,  362 => 152,  355 => 148,  350 => 146,  346 => 145,  342 => 144,  338 => 143,  334 => 142,  331 => 141,  329 => 140,  324 => 138,  317 => 134,  304 => 124,  298 => 121,  291 => 117,  288 => 116,  286 => 115,  276 => 111,  272 => 110,  269 => 109,  265 => 108,  263 => 107,  253 => 103,  249 => 102,  246 => 101,  242 => 100,  240 => 99,  234 => 96,  231 => 95,  229 => 94,  225 => 93,  221 => 92,  217 => 91,  213 => 90,  207 => 89,  196 => 80,  190 => 77,  187 => 76,  185 => 75,  182 => 74,  180 => 73,  178 => 72,  169 => 69,  165 => 68,  162 => 67,  158 => 66,  148 => 59,  144 => 58,  140 => 57,  136 => 56,  133 => 55,  131 => 54,  129 => 53,  123 => 50,  118 => 49,  112 => 47,  110 => 46,  106 => 44,  104 => 43,  102 => 42,  94 => 39,  90 => 37,  88 => 36,  80 => 33,  76 => 31,  74 => 30,  66 => 27,  62 => 25,  60 => 24,  52 => 21,  48 => 19,  46 => 18,  38 => 15,  34 => 13,  32 => 12,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "invoice.xml.twig", "D:\\Proyecto2018\\SistemaControlV1.1\\vendor\\greenter\\xml\\src\\Xml\\Templates\\invoice.xml.twig");
    }
}
