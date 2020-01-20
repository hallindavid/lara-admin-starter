<template>
  <div>
    <b-container fluid>
        <div class="row justify-content-end mb-2">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Search for an Organization" v-model="filter"/>
                    </div>
                </div>
            </div>
        </div>

      <b-row>
        <div class="col-sm-12">
          <div class="table-responsive">
            <b-table id="table"
                     class="table table-striped table-bordered table-hover"
                     :per-page="perPage"
                     :fields="fields"
                     :items="list"
                     :current-page="currentPage"
                     :filter="filter">
                <template v-slot:cell(owner)="data">
                  {{data.item.owner_first_name}} {{data.item.owner_last_name}}
                </template>
                <template v-slot:cell(created_at)="data">
                  {{data.value.substr(0,10)}}
                </template>
                <template v-slot:cell(change)="data">
                    <b-button @click="edit_organization(data.item)" variant="primary" size="xs"><i class="fas fa-fw fa-pencil-alt"></i></b-button>
                    <button @click="delete_organization(data.item.id)" type="button" class="btn-danger btn-xs"><i class="fas fa-fw fa-trash-alt"></i></button>

                </template>
            </b-table>
          </div>
          <b-pagination v-model="currentPage"
                        align="fill"
                        :total-rows="rows"
                        :per-page="perPage"
                        aria-controls="table"
                        :filter="filter">
          </b-pagination>
        </div>
      </b-row>
    </b-container>



    <b-modal id="edit_organization" size="lg" title="Edit Organization" @ok="update_organization" ok-title="Save">
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Organization</label>
        <div class="col-sm-10">
          <input type="name" class="form-control" id="name" v-model="organization.name">
        </div>
      </div>
    </b-modal>
    <vue-snotify></vue-snotify>
  </div>

</template>

<script>

  export default {
    //Variables/Fields
    data: function() {
      return {
        fields: [
          { key: 'name', sortable: true },
          { key: 'owner', label:'Owner Name' , sortable:true},
          { key: 'created_at', label:'Created On', sortable: true },
          { key: 'change',label:'Change'},
        ],
        perPage: 15,
        currentPage: 1,
        filter: null,
        list: [],
        organization: {
          id: null,
          name:'',
          user_id:'',
        },
      }
    },
    //When loaded, call get_organization_list
    mounted: function() {
      this.get_organization_list();
    },
    computed: {
      rows() {
        return this.list.length
      }
    },
    methods: {
      get_organization_list: function() {
        axios
          .get('/api/admin/organization/')
          .then(response => {
            this.list = response.data.data;
          })
          .catch(error => {
            alert(error)
          })
        return
      },

      edit_organization: function(item) {
          this.organization.id = item.id;
          this.organization.name = item.name;
          this.organization.user_id = item.user_id;
          this.$bvModal.show('edit_organization');
      },

      update_organization: function(bvModalEvt) {
          bvModalEvt.preventDefault();
          axios.put('/api/admin/organization/'+this.organization.id, this.organization)
          .then(res => {
            console.log(res)
              this.global_success('Success', 'The organization has been updated.');
              this.$bvModal.hide('edit_organization');
              this.get_organization_list();
          })
          .catch(err => {
              this.axios_catch(err);
          })
      },

      delete_organization: function(id) {
        let self = this;
        if (confirm('Are you sure you want to deactivate this organization?')) {
          axios
            .delete('/api/admin/organization/' + id)
            .then(response => {
              if(response.data!="")
              this.global_warning('Warning',response.data)
              else
              this.global_success('Success','The organization has been deleted.');
              this.get_organization_list();
            })
            .catch(err=> {
              this.axios_catch(err)
            })
        }
      },
    }
  }

</script>
