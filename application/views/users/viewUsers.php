<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div style='display:none' class="loader"></div>

<h4 style="font-size:20pt">Data Pegawai Kementrian dalam negeri</h4>
<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <label for="sel1">Lembaga</label>
            <select class="form-control" id="pilihLembaga">
                <option value="">==Pilih Lembaga==</option>
                <?php foreach($lembagas as $list){
                        ?>
                <option value="<?php echo $list['id_lembaga']?>">
                    <?php echo $list['nama_lembaga']?></option>
                <?php
                        }?>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="sel1">Pilih Tingkat</label>
            <select class="form-control" id="pilihTingkat" disabled>
                <option value="">==Pilih Tingkatan==</option>
                <?php foreach($tingkats as $list){
                    ?>
                <option value="<?php echo $list['id_tingkat']?>">
                    <?php echo $list['keterangan']?></option>
                <?php
                    }?>

            </select>
        </div>
    </div>

</div>

<button id="btnLihatAntrian" onclick="tableUsers()" class="btn btn-info" disabled>Lihat Pegawai</button>

<br>
<br>

<div id="listUsersDiv" style="display:none">
    <button id='tambahUser' style="display:none" class="btn btn-success" onclick="userAdd()"><i class="fa fa-plus"></i>
        Tambah</button>
    <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button>
    <br />
    <br />
    <div class="table-responsive">
        <table id="tableUsers" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama Pegawai</th>
                    <th>NIP</th>
                    <th>Jabatan</th>
                    <th>Lembaga</th>
                    <th>Sub direktorat</th>
                    <th>Seksi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>



<script type="text/javascript">
let save_method; //for save method string
let table;
let base_url = '<?php echo base_url();?>';

jQuery(document).ready(function() {

    $('#pilihLembaga').change(function() {
        if ($(this).val() != '') {
            $('#pilihTingkat').prop('disabled', false);
            $('#pilihTingkat').change(function() {
                if ($("#pilihTingkat").val() != '') {
                    $('#btnLihatAntrian').prop('disabled', false);
                    $("#listUsersDiv").hide();
                } else {
                    $('#btnLihatAntrian').prop('disabled', true);
                    $('#tableUsers').DataTable().clear();
                    $('#tableUsers').DataTable().destroy();
                    $("#listUsersDiv").hide();
                }
            });
            $("#listUsersDiv").hide();

        } else {
            $('#pilihTingkat').prop('disabled', true);
            $("#pilihTingkat").val("").change();
            $('#btnLihatAntrian').prop('disabled', true);
            $('#tableUsers').DataTable().clear();
            $('#tableUsers').DataTable().destroy();
            $("#listUsersDiv").hide();
        }
    });
});

function tableUsers() {
    let idLembaga = $("#pilihLembaga").val();
    let idTingkat = $("#pilihTingkat").val();
    let idTingkatUser = '<?php echo $this->ion_auth->user()->row()->tingkat;?>';
    let intIdTingkat = Number(idTingkat)
    let intIdTingkatUser = Number(idTingkatUser);

    $('.loader').fadeIn(function() {
        if (intIdTingkat <= intIdTingkatUser) {
            //tampilkan tombol
            $('#tambahUser').hide();
        } else {
            $('#tambahUser').show();
        }
        $('#tableUsers').DataTable().clear();
        $('#tableUsers').DataTable().destroy();
        $("#listUsersDiv").show();

        table = $('#tableUsers').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('users/usersRead')?>" + "?idLembaga=" + idLembaga +
                    "&idTingkat=" + idTingkat,
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
                },
                {
                    "targets": [-2], //2 last column (photo)
                    "orderable": false, //set not orderable
                },
            ],

        });
    });
    $('.loader').fadeOut();
}

function userAdd() {
    $('#subShow').hide();
    $('#seksiShow').hide();
    let idTingkat = $("#pilihTingkat").val();
    let idLembaga = $("#pilihLembaga").val();

    if (idTingkat == 4 || idTingkat == 3) {
        $('#subShow').show();
        $('#seksiShow').show();
    }
    if (idTingkat == 2) {
        $('#subShow').show();
    }

    $('#pilihJabatan').val(idTingkat);
    $('#pilihJabatan').text($("#pilihTingkat option:selected").text());

    $('#pilihLembagaModal').val(idLembaga);
    $('#pilihLembagaModal').text($("#pilihLembaga option:selected").text());

    save_method = 'add';
    $('#formPegawai')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modalPegawai').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Pegawai'); // Set Title to Bootstrap modal title
}

function userEdit(id) {
    $('#subShow').hide();
    $('#seksiShow').hide();
    let idTingkat = $("#pilihTingkat").val();
    let idLembaga = $("#pilihLembaga").val();

    if (idTingkat == 4 || idTingkat == 3) {
        $('#subShow').show();
        $('#seksiShow').show();
    }
    if (idTingkat == 2) {
        $('#subShow').show();
    }

    $('#pilihJabatan').val(idTingkat);
    $('#pilihJabatan').text($("#pilihTingkat option:selected").text());

    $('#pilihLembagaModal').val(idLembaga);
    $('#pilihLembagaModal').text($("#pilihLembaga option:selected").text());

    save_method = 'update';
    $('#formPegawai')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#passwordShow').hide();


    //Ajax Load data from ajax
    $.ajax({
        url: "<?php echo site_url('users/userEdit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {

            $('[name="idPegawai"]').val(data.idPegawai);
            $('[name="namaPegawai"]').val(data.namaPegawai);
            $('[name="nip"]').val(data.nip);
            $('[name="subDirektorat"]').val(data.subDirektorat);
            $('[name="seksi"]').val(data.seksi);
            $('[name="email"]').val(data.email);
            $('[name="phone"]').val(data.phone);

            $('#modalPegawai').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit User')

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
}

function userSimpan() {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable 
    var url;

    if (save_method == 'add') {
        url = "<?php echo site_url('users/userAdd')?>";
    } else {
        url = "<?php echo site_url('users/userUpdate')?>";
    }

    // ajax adding data to database

    var formData = new FormData($('#formPegawai')[0]);
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data) {

            if (data.status) //if success close modal and reload ajax table
            {
                $('#modalPegawai').modal('hide');
                reload_table();
            } else {
                for (var i = 0; i < data.inputerror.length; i++) {
                    $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass(
                        'has-error'
                    ); //select parent twice to select div form-group class and add has-error class
                    $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[
                        i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled', false); //set button enable 


        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled', false); //set button enable 

        }
    });
}

function userDelete(id) {
    if (confirm('kamu serius akan menghapus User ini?')) {
        // ajax delete data to database
        $.ajax({
            url: "<?php echo site_url('users/userDelete')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                //if success reload ajax table
                $('#modalPegawai').modal('hide');
                reload_table();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error deleting data');
            }
        });

    }
}
</script>



<!-- Bootstrap modal -->
<div class="modal fade" id="modalPegawai" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Pegawai</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="formPegawai" class="form-horizontal">
                    <input type="hidden" value="" name="idPegawai" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Pegawai</label>
                            <div class="col-md-9">
                                <input
                                    oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"
                                    name="namaPegawai" placeholder="Nama Pegawai" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">NIP</label>
                            <div class="col-md-9">
                                <input
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    name="nip" placeholder="NIP" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jabatan</label>
                            <div class="col-md-9">
                                <select name="jabatan" class="form-control">
                                    <option value="" id='pilihJabatan'>Jabatan</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Lembaga</label>
                            <div class="col-md-9">
                                <select name="lembaga" class="form-control">
                                    <option value="" id='pilihLembagaModal'>Lembaga</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group" id='subShow' style="display:none">
                            <label class="control-label col-md-3">Sub Direktorat</label>
                            <div class="col-md-9">
                                <select name="subDirektorat" class="form-control">
                                    <option value="">==Pilih Sub Direktorat==</option>
                                    <?php foreach($subDirektorat as $list){
                                    ?>
                                    <option value="<?php echo $list['id_sub']?>">
                                        <?php echo $list['keterangan']?></option>
                                    <?php
                                    }?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group" id='seksiShow' style="display:none">
                            <label class="control-label col-md-3">Seksi</label>
                            <div class="col-md-9">
                                <select name="seksi" class="form-control">
                                    <option value="">==Pilih Seksi==</option>
                                    <?php foreach($seksi as $list){
                                    ?>
                                    <option value="<?php echo $list['id_seksi']?>">
                                        <?php echo $list['keterangan']?></option>
                                    <?php
                                    }?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input name="email" placeholder="Email" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nomor HP</label>
                            <div class="col-md-9">
                                <input name="phone" placeholder="Nomor HP" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id='passwordShow'>
                            <label class="control-label col-md-3">Password</label>
                            <div class="col-md-9">
                                <input name="password" placeholder="Password" value='kemendagri' class="form-control"
                                    type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="userSimpan()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->