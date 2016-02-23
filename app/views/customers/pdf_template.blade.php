<html>
<head>
<title>Invoice</title>
<style type="text/css">
    #page-wrap {
        width: 700px;
        margin: 0 auto;
    }
    .center-justified {
        text-align: justify;
        margin: 0 auto;
        width: 30em;
    }
    table.outline-table {
        border: 1px solid;
        border-spacing: 0;
    }
    tr.border-bottom td, td.border-bottom {
        border-bottom: 1px solid;
    }
    tr.border-top td, td.border-top {
        border-top: 1px solid;
    }
    tr.border-right td, td.border-right {
        border-right: 1px solid;
    }
    tr.border-right td:last-child {
        border-right: 0px;
    }
    tr.border {
        border: 1px solid;
    }
    tr.center td, td.center {
        text-align: center;
        vertical-align: text-top;
    }
    td.pad-left {
        padding-left: 5px;
    }
    tr.right-center td, td.right-center {
        text-align: right;
        padding-right: 50px;
    }
    tr.right td, td.right {
        text-align: right;
    }
    .grey {
        background:lightgrey;
    }
</style>
</head>
<body>
    <br>
    <div id="page-wrap">
        <table width="100%">
            <tbody>
                <tr>
                    <td width="70%">
                        <h3 style="margin:0px;padding:0px"><strong>{{ $settings->name }}</strong></h3>           
                        {{ $settings->address1 }}<br>                        
                        {{ $settings->city }}, {{ $settings->state }}<br>                        
                        {{ $settings->zip }}<br>
                    </td>
                    <td width="30%">
                        <img width="150px" src='uploads/logo/{{ $settings->logo}}'> 
                        
                        

                        
                    </td>
                </tr>

                <tr>
                    <td width="70%">



                        <h3 style="margin:0px;padding:0px;padding-top:50px;">Bill To:</h3>
                        
                        
                        {{ $customer->name }}<br>
                        {{ $customer->address1 }}<br>
                        {{ $customer->city }}, {{ $customer->state }}<br>
                        {{ $customer->zip }}</p>
                        
                        <br>
                        <p><b>Account Number:</b> <br>{{ $customer->sid }} </p>
                    </td>
                    <td width="30%">
                        <h3 style="margin:0px;padding:0px;">Invoice: </h3> 
                        {{ $name = strtoupper(substr( $customer->name ,0,3)) ."-". rand(100000,20000) ."-". date("Y-m-d"); }}
                        <br><br>
                        
                        <h3 style="margin:0px;padding:0px;">Date: </h3> 
                        {{ date("m/d/Y") }}
                        <br><br>

                        <h3 style="margin:0px;padding:0px;">PO#: </h3> 
                        {{ $customer->po }} 
                        
                    </td>
                    
                </tr>
                    
                
            </tbody>
        </table>
        <p>&nbsp;</p>
        <table width="100%" class="outline-table">
            <tbody>
                <tr class="border-bottom border-right grey">
                    <td colspan="2" class="pad-left"><strong>Summary</strong></td>
                    
                </tr>
                <tr class="border-bottom border-right center">
                    <td width="80%"><strong>Description</strong></td>                   
                    <td width="20%"><strong>Amount</strong></td>
                </tr>
                
               

                <tr class="border-right border-bottom">
                    <td width="80%">Prepay usage</td>
                    <td class="center" width="20%"> {{'$' . number_format( $customer->prepay_amount ,2) }}</td>
                </tr>
                <tr class="border-right ">
                    <td width="80%"><strong>Total</strong></td>
                    <td class="center" width="20%"> <strong>{{'$' . number_format( $customer->prepay_amount ,2) }}</strong></td>
                </tr>
                
                
                
            </tbody>
        </table>
        <p>&nbsp;</p>
        
        <p>&nbsp;</p>
        
        <table width="100%">
            <tbody>
                <tr>
                    <td width="50%">
                        <div class="center-justified">
                            <strong>
                            {{-- To make a payment: --}}
                            </strong><br>
                            {{-- Your payment options --}}
                            <br>                            
                        </div>
                    </td>
                    <td width="50%">
                        <div class="center-justified">
                        <p>Terms: Net 30<br>
                        Copyright {{ $settings->name }} 2015</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p>&nbsp;</p>
       
    </div>
</body>
</html>