<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div style='display:none' class="loader"></div>
<h1 style="font-size:20pt">Data Sub Direktorat Kementrian dalam negeri</h1>
<?php
if($this->ion_auth->user()->row()->lembaga==0){
?>
<button class="btn btn-success" onclick="subAdd()"><i class="fa fa-plus"></i> Tambah</button>
<?php
}
?>
<button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button>
<br />
<br />
<div class="table-responsive">

    <table id="tableSub" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Nama subdirektorat</th>
                <th>Nama Kepala</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>



<script type="text/javascript">
var save_method; //for save method string
var table;
var base_url = '<?php echo base_url();?>';

jQuery(document).ready(function() {
    table = $('#tableSub').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('sub/subRead')?>",
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


function subAdd() {
    save_method = 'add';
    $('#formSub')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modalSub').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Subdirektorat'); // Set Title to Bootstrap modal title
}

function subEdit(id) {
    save_method = 'update';
    $('#formSub')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string


    //Ajax Load data from ajax
    $.ajax({
        url: "<?php echo site_url('sub/subEdit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {

            $('[name="idSub"]').val(data.id_sub);
            $('[name="namaSub"]').val(data.keterangan);
            $('[name="namaKepalaSub"]').val(data.nama_kepala);
            $('[name="status"]').val(data.status);
            $('#modalSub').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Seksi')

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
}

function subSimpan() {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable 
    var url;

    if (save_method == 'add') {
        url = "<?php echo site_url('sub/subAdd')?>";
    } else {
        url = "<?php echo site_url('sub/subUpdate')?>";
    }

    // ajax adding data to database

    var formData = new FormData($('#formSub')[0]);
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
                $('#modalSub').modal('hide');
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

function subDelete(id) {
    if (confirm('kamu serius akan menghapus Subdirektorat ini?')) {
        // ajax delete data to database
        $.ajax({
            url: "<?php echo site_url('sub/subDelete')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                //if success reload ajax table
                $('#modalSub').modal('hide');
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
<div class="modal fade" id="modalSub" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Lembaga</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="formSub" class="form-horizontal">
                    <input type="hidden" value="" name="idSub" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Subdirektorat</label>
                            <div class="col-md-9">
                                <input
                                    oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"
                                    name="namaSub" placeholder="Nama Subdirektorat" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Kelapa Subdirektorat</label>
                            <div class="col-md-9">
                                <input
                                    oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"
                                    name="namaKepalaSub" placeholder="Nama Kepala Subdirektorat" class="form-control"
                                    type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <select name="statusSub" class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Non Aktif</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="subSimpan()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->