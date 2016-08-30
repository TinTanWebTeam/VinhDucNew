<div id="page-wrapper" name = "report">
    <div class="row">
        <div class="col-lg-12">
            <h4 style="color: #00a859">Report</h4>
            <hr style="margin-top: 0px;color: #00a859">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row" style="text-align: center; font-family: 'Times New Roman'">
        <div class="col-md-6 col-sm-6">
            <h4><b>CÔNG TY TNHH TM DV CSSK VĨNH ĐỨC</b></h4>
        </div>
        <div class="col-md-6 col-sm-6 pull-right">
            <h4><b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</b><br></h4>
            <h5><b>Độc Lập – Tự Do – Hạnh Phúc</b></h5>
        </div>
    </div>
    <div class="row" style="text-align: center; font-family: 'Times New Roman'">
        <h3><b>HỒ SƠ BỆNH ÁN VẬT LÝ TRỊ LIỆU</b></h3>
    </div>
    <div class="row" style="font-family: 'Times New Roman'">
        <div class="row col-md-12">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <div class="col-md-6" style="text-align: center;">
                        <span>Mã BS:</span>
                        <span name="codeDoctor"></span>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>

        </div>
        <div class="row col-md-12">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <div class="col-md-6" style="text-align: center;">
                        <span>Mã BN:</span>
                        <span name="codePatient"></span>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>

        </div>
        <div class="row col-md-12">
                <h4><b>I-HÀNH CHÍNH</b></h4>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-6 col-sm-6">
                        <span>1. Họ và tên:</span>
                        <span name="Fullname"></span>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div>
                            <span class="col-md-6 col-sm-6">Năm sinh:</span>
                            <span name="Birthday"></span>
                        </div>
                       <div>
                           <span class="col-md-6 col-sm-6">Giới tính:</span>
                           <span name="Sex"></span>
                       </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-6 col-sm-6">
                        <span>2. Nghề nghiệp:</span>
                        <span name="Job"></span>
                    </div>
                    <div>
                        <span class="col-md-6 col-sm-6">Số điện thoại:</span>
                        <span name="Phone"></span>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-6 col-sm-6">
                        <span>3. Địa chỉ:</span>
                        <span name="Address"></span>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-6 col-sm-6">
                        <span>4. Huyết áp:</span>
                        <span name="bloodPressure"></span>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-6 col-sm-6">
                        <span>5. Mạch:</span>
                        <span name="Pulse"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-md-12">
            <h4><b>II-BỆNH SỬ</b></h4>
            <div class="col-md-12">
                <span>1. Quá trình bệnh lý:</span>
                <span name="QTBL"></span>
            </div>
            <div class="col-md-12">
                <span>2. Tiền sử bệnh:</span>
                <span name="TSB"></span>
            </div>
        </div>
        <div class="row col-md-12">
            <h4><b>III-CẬN LÂM SÀNG:</b></h4>
            <span name="CLS"></span>
        </div>
        <div class="row col-md-12">
            <h4><b>IV-CHẨN ĐOÁN:</b></h4>
            <span name="CD"></span>
        </div>
        <div class="row col-md-12">
            <h4><b>V-PHÁC ĐỒ:</b></h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover order-column" id="tableRegimen"
                       style="margin-bottom: 0px;">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Vùng</th>
                        <th>Điều trị chuyên môn</th>
                        <th>Vị trí điều trị</th>
                        <th>Phút</th>
                    </tr>
                    </thead>
                    <tbody id="tbodyRegimen">
                    </tbody>
                </table>

            </div>
        </div>

    </div>

</div>