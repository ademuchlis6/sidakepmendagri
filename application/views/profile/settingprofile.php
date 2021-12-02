<?php
				defined('BASEPATH') or exit('No direct script access allowed');
				?>

<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item active">
        <a class="nav-link" href="#profile" role="tab" data-toggle="tab">Ubah Password</a>
    </li>
</ul>
<div style='display:none' class="loader"></div>

<!-- Tab panes -->
<div class="tab-content">

    <div role="tabpanel" class="tab-pane fade in active" id="profile">
        <div class="col-md-6">
            <div style="text-align:center;" class="card-header">
                <h3>Ubah Password</h3>
            </div>
            <div class="form-group has-success has-feedback">
                <label class="control-label" for="inputSuccess2">Password Baru</label>
                <input id="passbaru1" type="password" class="form-control" autocomplete="false"
                    placeholder="Input Password" name="password" aria-label="Recipient's username"
                    aria-describedby="basic-addon2">
                <div onclick="show1('newPass')">
                    <span class="form-control-feedback"><i id="p1" toggle="#password-field"
                            class="fa fa-fw fa-eye field-icon toggle-password"></i></span>
                </div>
                <div class="nullpass1" style="color:red;display:none">
                    Tidak Boleh Kosong
                </div>
            </div>
            <div class="form-group has-success has-feedback">
                <label class="control-label" for="inputSuccess2">Ulangi Password Baru</label>
                <input id="passbaru2" type="password" class="form-control" autocomplete="false"
                    placeholder="Input Password" name="password" aria-label="Recipient's username"
                    aria-describedby="basic-addon2">
                <div onclick="show2('newPass')">
                    <span class="form-control-feedback"><i id="p2" toggle="#password-field"
                            class="fa fa-fw fa-eye field-icon toggle-password"></i></span>
                </div>
                <div id="notmatch" style="color:red;display:none">
                    Password tidak sama
                </div>
                <div class="nullpass2" style="color:red;display:none">
                    Tidak Boleh Kosong
                </div>
            </div>
            <button id="savechangepass" class="btn btn-primary" onclick="savechangepass()">Simpan</button>
        </div>
    </div>

</div>


<script type="text/javascript">
function show1(id) {
    var a = document.getElementById('passbaru1');
    $("#p1").toggleClass("fa-eye fa-eye-slash");

    if (a.type == "password") {
        a.type = "text";
        $('#td_id').removeClass('fa-eye').addClass('fa-slash');
    } else {
        a.type = "password";

    }
}

function show2(id) {
    var a = document.getElementById('passbaru2');
    $("#p2").toggleClass("fa-eye fa-eye-slash");

    if (a.type == "password") {
        a.type = "text";
        $('#td_id').removeClass('fa-eye').addClass('fa-slash');
    } else {
        a.type = "password";

    }
}

function savechangepass() {

    var passbaru1 = document.getElementById("passbaru1").value;
    var passbaru2 = document.getElementById("passbaru2").value;


    if (passbaru1 == "") {
        $('.nullpass1').show();
        return false;
    } else if (passbaru2 == "") {
        $('.nullpass2').show();
        return false;
    } else if (passbaru1 != passbaru2) {
        $('#notmatch').show();
        return false;
    } else {
        //                alert('logic benar');

        $.ajax({
            url: "<?php echo site_url('profile/changepass')?>",
            data: {
                passbaru1: passbaru1,
                passbaru2: passbaru2
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == 'ok') {
                    alert("Password berhasil di ubah");
                    window.location.href = "<?php echo site_url('auth/logout')?>";

                };
            },
            error: function(jqXHR, textStatus, errorThrown) {

            }
        });

    }
}
</script>