<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPD Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .header-text {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .hospital-logo {
            height: 80px;
        }



        .rx-symbol {
            font-size: 2rem;
            font-weight: bold;
        }

        .footer-note {
            font-size: 0.85rem;
            font-style: italic;
        }

        p {
            margin-bottom: 2px;
        }

        .footer-section {
            margin-top: 50px;
            display: flex;
            justify-content: end;
        }
    </style>

</head>

<body>
    <div class=" mt-4 border p-3">
        <div class="row">
            <div class="col-2">
                <img src="{{url('img/bd.png')}}"  alt="Hospital Logo" class="img-fluid hospital-logo" />
            </div>
            <div class="col-8 text-center">
                <div class="header-text">বঙ্গবন্ধু শেখ মুজিব মেডিক্যাল বিশ্ববিদ্যালয়</div>
                <div>Bangabandhu Sheikh Mujib Medical University</div>
                <div>Address: Shahbag, Dhaka-1000</div>
                <div>
                    {{-- Contact: 02-55062388 | Email: kurmitola500bed@hospi.dghs.gov.bd --}}
                </div>
            </div>
            <div class="col-2 text-end">
                <img src="{{url('img/logo.png')}}" alt="Department Logo" class="img-fluid hospital-logo" />
            </div>
        </div>
        <hr style="height: 2px; background-color: #000;" />
        <h4 class="text-center mb-4">OPD TICKET</h4>
        <div class="row mb-3">
            <div class="col-9">
                <div class="row">
                    <div class="col-6">
                        <p> <strong> Ticket ID: </strong>RX241105577</p>
                        <p> <strong> Patient ID: </strong>PT2411006557</p>
                        <p> <strong> Gender: </strong>Male</p>
                    </div>
                    <div class="col-6">
                        <p> <strong> Name: </strong>MIRAZ</p>
                        <p> <strong> Age: </strong>02Y 03M 28D</p>
                        <p> <strong> Contact: </strong>01732720684</p>
                    </div>
                </div>

                <p><strong>Visit Date: </strong>06 Nov 2024 from 08:00 AM to 10:00 AM</p>
            </div>
            <div class="col-3 ">

                <p>
                    <strong>Health ID:</strong>
                <div class="barcode">
                    <img src="{{url('img/barcode.png')}}" alt="Barcode" class="img-fluid" style="width: 76px;" />
                    <div>RX241105577</div>
                </div>
                </p>
            </div>
        </div>
        <div class="text-center" style="border-bottom: 2px solid #000;">
            <p><strong>Department:</strong> শিশু (Paediatrics)-388</p>
        </div>
        <div class="row mt-4" style="height: 300px;">
            <div class="col-3" style="border-right: 2px solid #000;">
            </div>
            <div class="col-9 p-4">
                <div class="rx-symbol">Rx</div>

            </div>
        </div>
        <footer>
            <div class="footer-section">

                <div class="text-end">
                    <p>Signature & Seal</p>
                    <p>Name: __________________</p>
                    <p>Designation: __________________</p>
                    <p>BMDC No: __________________</p>
                </div>
            </div>
            <div class="d-flex justify-content-center p-3 mt-4"
                style="border-top: 2px solid #000; border-bottom: 2px solid #000;">
                <div class="">
                    <p>পরবর্তী সাক্ষাৎ: _______ দিন / সপ্তাহ / মাস পর</p>
                    <p class="footer-note">
                        Note: This ticket is valid till 06 Nov 2024 from 08:00 AM to 10:00 AM
                    </p>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <p class="footer-note">
                    Powered by: MySoft Heaven Bd LTD
                </p>
                <p class="footer-note">
                    Printed by: Miraz, at Online Ticket Counter, 01:02:25 PM, 06 Nov 2024
                </p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
