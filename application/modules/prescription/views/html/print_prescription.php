<style>
body {
    font-family: Arial, sans-serif;
}
.prescription-container {
    width: 700px;
    margin: auto;
    padding: 20px;
    border: 2px solid #000;
    background: #fff;
}
.prescription-header {
    text-align: center;
    color: #007bff;
    font-size: 24px;
    font-weight: bold;
}
.doctor-info {
    text-align: center;
    margin-bottom: 20px;
}
.patient-info {
    border-bottom: 2px solid #000;
    padding-bottom: 10px;
    margin-bottom: 20px;
}
.rx-symbol {
    font-size: 48px;
    font-weight: bold;
    color: #000;
}
.signature {
    border-top: 1px solid #000;
    width: 200px;
    margin-top: 50px;
    text-align: center;
}
.print-btn {
    display: block;
    margin: 20px auto;
    padding: 10px 20px;
    font-size: 16px;
    background: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}
</style>


<div id="prescriptionContent" class="prescription-container">
    <div class="prescription-header">Hospital Name</div>
    <div class="doctor-info">
        <strong>Dr. John Killer M.B.B.S, M.Ortho</strong><br>
        751 Victoria 123 Street, South State 204<br>
        Hometown US 1234<br>
        <small>Ph: (207) 806 2014-2014 | Fax: (207) 806 2015-2022</small>
    </div>
    
    <div class="patient-info">
        <strong>Patient Name:</strong> <span id="patientName">________</span> &nbsp;&nbsp;
        <strong>Age:</strong> <span id="patientAge">__</span> &nbsp;&nbsp;
        <strong>Gender:</strong> <span id="patientGender">__</span><br>
        <strong>Address:</strong> <span id="patientAddress">________</span><br>
        <strong>Date:</strong> <span id="prescriptionDate">__</span>
    </div>

    <div class="rx-symbol">Rx</div>
    <p id="prescriptionDetails">__________________________</p>

    <div class="signature">Doctor’s Signature</div>
</div>