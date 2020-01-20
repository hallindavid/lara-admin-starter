<template>
  <div>
    <userorgs ref="userorgs"></userorgs>
    <edituser @updated="get_user_list" ref="edituser"></edituser>
    <b-container fluid>
        <div class="row justify-content-end mb-2">
            <div class="col-lg-5">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Search for a User" v-model="filter"/>
                    </div>
                    <div class="col">
                        <adduser @added="get_user_list"></adduser>
                    </div> <!-- end div col -->
                </div> <!-- end div row -->
            </div> <!-- end div col lg -->
        </div> <!-- end div row -->
      <!-- b-row for table -->
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
                <template v-slot:cell(name)="data">
                    {{data.item.first_name}} {{data.item.last_name}}
                </template>
                <template v-slot:cell(email)="data">
                  {{ data.item.email }}
                </template>
                <template v-slot:cell(location)="data">
                  {{data.item.state}}, {{data.item.country}}
                </template>
                <template v-slot:cell(is_admin)="data">
                  <template v-if="data.value">
                    True
                  </template>
                  <template v-else>
                    False
                  </template>

                </template>
                <template v-slot:cell(change)="data">
                    <b-button @click="edit_user(data.item)" variant="primary" size="xs"><i class="fas fa-fw fa-pencil-alt"></i></b-button>
                    <b-button @click="edit_user_organizations(data.item)" variant="success" size="xs"><i class="fas fa-sitemap"></i></b-button>
                    <button @click="delete_user(data.item.id)" type="button" class="btn-danger btn-xs"><i class="fas fa-fw fa-trash-alt"></i></button>

                </template>
            </b-table>
          </div> <!-- End table-responsive -->
          <b-pagination v-model="currentPage"
                        align="fill"
                        :total-rows="rows"
                        :per-page="perPage"
                        aria-controls="table"
                        :filter="filter">
          </b-pagination>
        </div> <!-- end div col 12 -->
      </b-row> <!-- end b-row -->
    </b-container> <!-- end b-container -->
  </div>
</template>

<script>

import adduser from './AddUser.vue';
import edituser from './EditUser.vue';
import UserOrgs from './UserOrgs.vue';
  export default {
    //Variables/Fields
    data: function() {
      return {
        fields: [
          { key: 'name', sortable: true },
          { key: 'email', sortable: true },
          { key: 'location', sortable: true },
          { key: 'timezone', sortable: true },
          { key: 'is_admin', label:'is Admin?', sortable: true },
          { key: 'change',label:'Change'},
        ],
        perPage: 15,
        currentPage: 1,
        filter: null,
        list: [],
      }
    },
    //When loaded, call get_user_list
    mounted: function() {
      this.get_user_list();
    },
    components: {
        adduser, 
        userorgs: UserOrgs,
        edituser: edituser,
    },
    computed: {
      rows() {
        return this.list.length
      }
    },
    methods: {
      //Main Methods 
      get_user_list: function() {
        axios
          .get('/api/admin/user/')
          .then(response => {
              this.list = response.data.data;
          })
          .catch(error => {
              this.axios_catch(error);
          })
        return
      },
      edit_user: function(u) {
          this.$refs.edituser.edit_user(u);
      },
      delete_user: function(id) {
        if (confirm('Are you sure you want to deactivate this user?')) {
          axios
            .delete('/api/admin/user/' + id)
            .then(res=> {
                this.global_success("User Deleted");
            })
            .catch(err=> {
                this.axios_catch(err);
            })
          window.$('#addModal').modal('toggle')
          this.get_user_list()
        }
      },
      edit_user_organizations: function(user) {
        this.$refs.userorgs.set_info(user.id);
      },  
    },
  }
</script>
