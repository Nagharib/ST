@extends('layouts.main')

@section('content')
<div class="row" id="promo">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <button class="btn btn-info" data-toggle="modal" data-target="#tambah-data">Tambah  Promo</button>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 350px;">
                  <input type="text" v-model="cari" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" @click.prevent="caripromo"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
           <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th style="white-space: nowrap;">Nama  Promo</th>
                  <th>Deskripsi</th>
                  <th>Image</th>
                  <th>Aksi</th>
                </tr>
                <tr v-for=" lay in promo.data">
                  <td>@{{lay.promo_name}}</td>
                  <td>@{{lay.description}}</td>
                  <td>@{{lay.img}}</td>
                  <td style="white-space: nowrap;">
                    <button class="btn btn-info btn-xs" @click.prevent="editpromo(lay)">Edit</button>
                                <button class="btn btn-danger btn-xs" @click.prevent="hapuspromo(lay.id)">Delete</button>
                  </td>
                </tr>
              </table>

                <vue-pagination  v-bind:pagination="pagination"
                     v-on:click.native="ambilpromo(pagination.current_page)"
                     :offset="4">
                </vue-pagination>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <!-- Modal Tambah Data -->
        <div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form method="POST" enc="multipart/form-data" v-on:submit.prevent="tambahpromo">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-name" id="myModalLabel">Tambah Data @{{dataBaru.promo_name}}</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="name">Nama  Promo:</label>
                  <input type="text" name="promo_name" class="form-control" v-model="dataBaru.promo_name" />
                  <span v-if="errorForm['promo_name']" class="error text-danger">@{{ errorForm['promo_name'] }}</span>

                  <input type="hidden" name="created_by" class="form-control" v-model="dataBaru.created_by" />
                  <span v-if="errorForm['created_by']" class="error text-danger">@{{ errorForm['created_by'] }}</span>

				</div> 
                <div class="form-group">
                  <label for="name">Deskripsi:</label>
                  <input type="text" name="description" class="form-control" v-model="dataBaru.description" />
                  <span v-if="errorForm['description']" class="error text-danger">@{{ errorForm['description'] }}</span>
                </div>
               


                   <div class="form-group">
                                        <label>Image</label>
                                        <!-- <input type="file" name="file_name[]" class="form-control" multiple> -->
                                        <file-input v-on:file-change="setFiles"></file-input>
                                    </div>





              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Model Edit -->
        <div class="modal fade" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form method="POST" enc="multipart/form-data" v-on:submit.prevent="ubahpromo(dataEdit.id)">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-name" id="myModalLabel">Edit Data @{{dataEdit.name_}}</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="name">Nama  promoahan:</label>
                  <input type="text" name="name" class="form-control" v-model="dataEdit.name" />
                  <span v-if="errorForm['name']" class="error text-danger">@{{ errorForm['name'] }}</span>

                  <input type="hidden" name="updated_by" class="form-control" v-model="dataEdit.updated_by" />
                  <span v-if="errorForm['updated_by']" class="error text-danger">@{{ errorForm['updated_by'] }}</span>
                </div>
               
                <div class="form-group">
                  <label for="name">Deskripsi:</label>
                  <input type="text" name="description" class="form-control" v-model="dataEdit.description" />
                  <span v-if="errorForm['description']" class="error text-danger">@{{ errorForm['description'] }}</span>
                </div>
                 <div class="form-group">
                  <label for="name">Alamat:</label>
                  <input type="text" name="address" class="form-control" v-model.number="dataEdit.address" />
                  <span v-if="errorForm['address']" class="error text-danger">@{{ errorForm['address'] }}</span>
                </div>
                  <div class="form-group">
                  <label for="name">Kabupaten:</label>
                  <input type="text" name="region" class="form-control" v-model.number="dataEdit.region" />
                  <span v-if="errorForm['region']" class="error text-danger">@{{ errorForm['region'] }}</span>
                </div>
                <div class="form-group">
                  <label for="name">Provinsi:</label>
                  <input type="text" name="province" class="form-control" v-model.number="dataEdit.province" />
                  <span v-if="errorForm['province']" class="error text-danger">@{{ errorForm['province'] }}</span>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        

        <div class="modal fade" id="hapus-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-name" id="myModalLabel">Hapus Data</h4>
              </div>
              <div class="modal-body">
                Yakin ingin menghapus data ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">N O</button>
                <button type="submit" class="btn btn-primary" @click.prevent="hapuskonfirmpromo(hapus_id)">O K</button>
              </div>
            </div>
          </div>
        </div>

      </div>

@push('script')
<script>



    var promo = new Vue({
    el: '#promo',
    data: {
      img: '',
      files:'',
    promo: null,
    dataBaru: {'promo_name':'','description':'','img':'','created_by':'{{ Auth::user()->id }}'},
    errorForm:{},
    dataEdit: {'promo_name':'','description':'','address':'','region':'','province':'','updated_by':'{{ Auth::user()->id }}'},
    cari: null,
    counter: 0,
    pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1
    },
    offset: 4,
    hapus_id:null
     },
    methods: {

      //UPLOAD


      ///

        ambilpromo:function(page){
      var cari = this.cari ? this.cari : '';
      this.errorForm = {};
            axios.get(base_url+'/api/promo?cari='+cari+'&page='+page).then(response => {
                this.promo = response.data;
          this.pagination = response.data;
            }).catch(errors => {
                console.error(errors);
            })
        },

  tambahpromo:function(){

    //UPLOAD


    let formData = new FormData();
        formData.append('file_name[]', this.files)

        axios.post('/api/images', formData)
          .then(res => {
            console.log("upload complete")
          })
          .catch(err => {
            console.log("gagal")
          })


    ///END UPLOAD ///
      var input = this.dataBaru;
      axios.post(base_url+'/admin/promo',input).then(response=>{
        this.dataBaru = {'promo_name':'','description':'','img':'','created_by':'{{ Auth::user()->id }}'};
        $("#tambah-data").modal('hide');
        this.ambilpromo(this.promo.current_page);
      }).catch(errors=>{
        if(errors.response){
          if(errors.response.status = 422){
            this.errorForm = errors.response.data;
          }
        } else {
          console.error(errors);
        }
      })
    },


    //upload

      setFiles (files){
        if (files != undefined){
          this.files = files
        }
      },

    //endupload//

   editpromo:function(promo){
      this.dataEdit.id = promo.id;
      this.dataEdit.name = promo.name;
      this.dataEdit.promo_kategori_id = promo.promo_kategori_id;
      this.dataEdit.description = promo.description;
      this.dataEdit.address = promo.address;
      this.dataEdit.region = promo.region;
      this.dataEdit.province = promo.province;
      this.dataEdit.updated_by = '{{ Auth::user()->id }}';
      $('#edit-data').modal('show');
    },

    ubahpromo:function(id){
      var input = this.dataEdit;
      axios.patch(base_url+'/admin/promo/'+id,input).then(response => {
        $('#edit-data').modal('hide');
        this.ambilpromo(this.promo.current_page);
      }).catch(errors=>{
        if(errors.response){
          if(errors.response.status = 422){
            this.errorForm = errors.response.data;
          }
        } else {
          console.error(errors);
        }
      })
    },

    hapuspromo:function(id){
      this.hapus_id = id;
      $('#hapus-data').modal('show');
    },

    hapuskonfirmpromo:function(id){
      axios.delete(base_url+'/admin/promo/'+id).then(response => {
        this.ambilpromo(this.promo.current_page);
        $('#hapus-data').modal('hide');
      }).catch(errors=>{
        console.error(errors);
      })
    },

    caripromo:function(){
      axios.get(base_url+'/api/promo?cari='+this.cari).then(response => {
        this.promo = response.data;
        this.pagination = response.data;
        console.log(this.pagination);
      }).catch(errors=>{
        console.error(errors);
      })
    }

    },
    created(){
        this.ambilpromo(this.pagination.current_page);
    }, 

    //upload

    components: {
      FileInput
    }

    //endupload//
});


</script>
<style scoped>
    img{
        max-height: 240px;
    }
</style>

@endpush
@endsection
