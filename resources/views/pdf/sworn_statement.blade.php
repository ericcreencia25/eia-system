<style>
    body {
        font: 10pt/175% Arial, sans-serif; /* 175% seems to correspond to 150% in MS Word */
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
<div style="border: 1px solid; padding:12px; margin-top: 10px;" >
    <center><b>SWORN STATEMENT OF ACCOUNTABILITY OF THE PROPONENT</b></center>
    <br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is to certify that all the information and commitments in this Initial Environmental Examination (IEE)
    Checklist Report are accurate and complete to the best of my knowledge.
    <br>
    <br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; By the authority vested in me by the <u><b>{{ $proponent->ProponentName}}</b></u> as <u><b>{{ $proponent->Designation}}</b></u>. I hereby commit to ensure implementation of
    all commitments, mitigating measures and monitoring requirements indicated in this IEE Checklist Report as well
    as the following:
    <br>
    <ol>
        <li>Conform to pertinent provisions of applicable environmental laws e.g., R.A. No. 6969 (Toxic Substances and Hazardous and Nuclear Wastes Control Act of 1990), R.A. No. 9003 (Ecological Solid Waste Management Act of 2000), R.A. No. 9275 (Philippine Clean Water Act of 2004), and R.A. No. 8749 (Philippine Clean Air Act of 1999).</li>
        <li>Abide and conform to LGU development plans and guidelines.</li>
        <li>Regularly submit reports to concerned agencies.</li>
    </ol>
    <br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; I hereby bind myself to answer any penalty that may be imposed arising from any misrepresentation or failure to state material information in this IEE Checklist.
    <br>
    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; In witness whereof, I hereby set my hand this ________ day of _______________ at __________________________.</p>
</div>
<div style="border: 1px solid; padding:12px; margin-top: 0px;" >
    <center>
        <u><b>{{ $proponent->ContactPerson}}</b></u>
        <br>
        {{ $proponent->Designation}}
        <br>
        {{ $proponent->ProponentName}}
    </center>
</div>
<div style="border: 1px solid; padding:12px; margin-top: 0px;" >
    SUBSCRIBED AND SWORN TO before me this ________ day of _______________ 201___, affiant exhibiting
    his/her Community Tax Certificate No. __________________________ issued at ______________________ on
    __________________________.     
    <br><br><br>
</div>
<div style="border: 1px solid; padding:12px; margin-top: 0px;" >
    Doc. No. _______________<br>
    Page No. _______________<br>
    Book No. _______________<br>
    Series of _______________
</div>
