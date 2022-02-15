<style>
body {
    font: 10pt/175% "Times New Roman", Times, serif; /* 175% seems to correspond to 150% in MS Word */
}
ul {
    list-style: none;
}
ul li:before {
    content: '- ';
    margin-left: -20px;
    margin-right: 10px;
}

p {
    letter-spacing: 1pt;
}
</style>
<center>
    <h3>
        Environmental Management Bureau<br>Environmental Impact Assessment Division
    </h3>
    <h2>
        ORDER OF PAYMENT
    </h2>
</center>
<table width="100%" style="border-collapse: collapse; border: 1px;">
    <tr>
        <th width="35%" style="text-align: left; padding-left: 50px;">
            Application Reference No.
        </th>
        <th width="5%" style="text-align: left;">:</th>
        <th width="50%" style="text-align: left;">
            {{$project->GUID}}
        </th>
    </tr>
    <tr>
        <th width="35%" style="text-align: left; padding-left: 50px;">
            Name of Project Proponent
        </th>
        <th width="5%" style="text-align: left;">:</th>
        <th width="50%"style="text-align: left;">
            {{$project->ProponentName}}
        </th>
    </tr>
    <tr>
        <th width="35%" style="text-align: left; padding-left: 50px;">
            Project Name
        </th>
        <th width="5%" style="text-align: left;">:</th>
        <th width="50%"style="text-align: left;">
            {{$project->ProjectName}}
        </th>
    </tr>
    <tr>
        <th width="35%" style="text-align: left; padding-left: 50px;">Project Location</th>
        <th width="5%" style="text-align: left;">:</th>
        <th width="50%"style="text-align: left;">
            {{$project->Address}} {{$project->Municipality}} , {{$project->Province}}</th>
    </tr>
    <tr>
        <th width="35%" style="text-align: left; padding-left: 50px;">Order of Payment Reference No.</th>
        <th width="5%" style="text-align: left;">:</th>
        <th width="50%"style="text-align: left;">{{$project->OrderOfPayment}}</th>
    </tr>
    <tr>
        <th width="35%" style="text-align: left; padding-left: 50px;">Order of Payment Date</th>
        <th width="5%" style="text-align: left;">:</th>
        <th width="50%"style="text-align: left;">{{$Date}}</th>
    </tr>
    <tr>
        <th width="35%" style="text-align: left; padding-left: 50px;">Agency Code</th>
        <th width="5%" style="text-align: left;">:</th>
        <th width="50%"style="text-align: left;">D1609</th>
    </tr>
    <tr>
        <th width="35%" style="text-align: left; padding-left: 50px;">Merchant/Agency Deposit Account No.</th>
        <th width="5%" style="text-align: left;">:</th>
        <th width="50%"style="text-align: left;">3402-2806-53</th>
    </tr>
    <tr>
        <th width="35%" style="text-align: left; padding-left: 50px;">Total Application Fee (MC 2018-002)</th>
        <th width="5%" style="text-align: left;">:</th>
        <th width="50%"style="text-align: left;">Php 5,070.00</th>
    </tr>
</table>
<div style="text-align: left; padding-left: 40px;">
    ______________________________________________________________________________________________
</div>
<div style="text-align: left; padding-left: 40px; font-size: 14px;">
    <b>
        For internet-based payment, please visit https://www.lbp-eservices.com/egps/portal/index.jsp. For Over-the-counter payment, see instruction below.
    </b>
</div>
<div style="text-align: left; padding-left: 40px; font-size: 16px;">
    1. Proceed to any landbank branches to fill-up the ONCOLL Payment Slip indicating the account reflected in the order of payment and the EMB as the Agency Name. Other fields should be accomplished as follows:
</div>
<div style="text-align: left; padding-left: 90px; font-size: 16px;">
    Reference No. 1: Project Name.
</div>
<div style="text-align: left; padding-left: 90px; font-size: 16px;">
    Reference No. 2: Agency Code.
</div>
<div style="text-align: left; padding-left: 90px; font-size: 16px;">
    Reference No. 3: Order of Payment Reference No.
</div>
<div style="text-align: left; padding-left: 40px; font-size: 16px;">
    2. Present Accomplished ONCOLL Payment Slip together with this Order of Payment and payment to the Bank Teller.
</div>
<div style="text-align: left; padding-left: 40px; font-size: 16px;">
    3. Secure Teller’s Validation
</div>
<div style="text-align: left; padding-left: 40px; font-size: 16px;">
    Note: Payment non-refundable.
</div>
<center>
    <div style="text-align: center; padding-left: 40px; font-size: 8px;">
<br><br>
*********************** THIS IS A COMPUTER GENERATED DOCUMENT ***********************
<br>
Date Generated: {{$todate}}
</center>
</div>


