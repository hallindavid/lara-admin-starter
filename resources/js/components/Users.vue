<template>
  <div>
    <b-container fluid>
        <div class="row justify-content-end mb-2">
            <div class="col-lg-5">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Search for a User" v-model="filter"/>
                    </div>
                    <div class="col">
                        <adduser @added="getUserList"></adduser>
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
                <template v-slot:cell(name)="data">
                    {{data.item.first_name}} {{data.item.last_name}}
                </template>
                <template v-slot:cell(email)="data">
                  <a href="#" @click="emailUser(data.item.email)">{{ data.item.email }}</a>
                </template>
                <template v-slot:cell(permissions)="data">
                  <template v-for="perm in data.item.permissions">
                    {{perm.title}},
                  </template>
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
                    <b-button @click="editUser(data.item)" variant="primary" size="xs"><i class="fas fa-fw fa-pencil-alt"></i></b-button>
                    <b-button @click="userPermissions(data.item)" variant="success" size="xs"><i class="fas fa-fw fa-user-shield"></i></b-button>
                    <button @click="deleteUser(data.item.id)" type="button" class="btn-danger btn-xs"><i class="fas fa-fw fa-trash-alt"></i></button>

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



    <b-modal id="edit_user" size="lg" title="Edit User" @ok="update_user" ok-title="Save">
        <div class="row">
            <div class="col-12">
                <div class="form-group row">
                    <label for="first_name" class="col-md-2 col-form-label text-md-right pr-2">First</label>
                    <div class="col-md-4">
                        <input type="text" id="first_name" class="form-control" placeholder="John" autocomplete="off" v-model="user.first_name">
                    </div>
                    <label for="last_name" class="col-md-2 col-form-label text-md-right pr-2">Last</label>
                    <div class="col-md-4">
                        <input type="text" id="last_name" class="form-control" placeholder="Doe" autocomplete="off" v-model="user.last_name">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-2 col-form-label text-md-right pr-2">Password</label>
                    <div class="col-md-4">
                        <input type="password" class="form-control" id="password" placeholder="Password" autocomplete="off" v-model="user.password">
                    </div>
                    <label for="is_admin" class="col-md-2 col-form-label text-md-right pr-2">Role</label>
                    <div class="col-md-4">
                        <select class="form-control" id="is_admin" v-model="user.is_admin">
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </b-modal>


    <b-modal id="user_permissions" size="lg" title="Permissions" ok-title="Save" @ok="update_permissions" cancel-title="Discard Changes">
        <b-table id="permissionsTable"
                    class="table table-striped table-bordered table-hover"
                    :per-page="permissions.perPage"
                    :fields="permissions.fields"
                    :items="permissions.list"
                    :current-page="permissions.currentPage"
                    :sort-by="permissions.sortBy">
            <template v-slot:cell(checked)="data">
                <center><b-form-checkbox size="lg" checked switch v-model="data.item.has_perm" ></b-form-checkbox></center>
            </template>
        </b-table>
    </b-modal>






  </div>

</template>

<script>

import adduser from './AddUser.vue';

  export default {
    //Variables/Fields
    data: function() {
      return {
        fields: [
          { key: 'name', sortable: true },
          { key: 'email', sortable: true },
          { key: 'is_admin', label:'is Admin?', sortable: true },
          { key: 'change',label:'Change'},
        ],
        perPage: 15,
        currentPage: 1,
        filter: null,
        list: [],
        user: {
          id: '',
          first_name: '',
          last_name:'',
          email: '',
          password: '',
          is_admin: 0,
        },
        permissions: {
            list: [],
            user: {},
            per_page: 15,
            currentPage:1,
            sortBy:'title',
            fields: [
                { key: 'title', sortable: true },
                { key: 'description', label:'Description' },
                { key: 'checked', label:'Checked', sortable: true },
            ]
        }
      }
    },
    //When loaded, call getUserList
    mounted: function() {
      this.getUserList();
      this.get_permissions();
    },
    components: {
        adduser
    },
    computed: {
      rows() {
        return this.list.length
      }
    },
    methods: {
      getUserList: function() {
        axios
          .get('/api/user/')
          .then(response => {
            this.list = response.data
          })
          .catch(error => {
            alert(error)
          })
        return
      },
      get_permissions: function() {
        axios
        .get('/api/permissions')
          .then(response => {
            this.permissions.list = response.data
          })
          .catch(err => {
            this.axios_catch(err);
          })
      },
      userPermissions: function(item) {
          console.log("Need to get permissions for user: ");
          console.log(item);

            this.permissions.list.forEach(function(perm, index) {
                if (item.permissions.includes(perm.id))
                {
                    perm['has_perm'] = true;
                } else {
                    perm['has_perm'] = false;
                }
            });

          this.permissions.user = item;
          this.$bvModal.show('user_permissions');
      },
      update_permissions: function(bvModalEvt) {
            bvModalEvt.preventDefault();

            var new_permissions = [];

            this.permissions.list.forEach(function(perm, index) {
                if (perm.has_perm)
                {
                    new_permissions.push(perm.id);
                }
            });

            this.permissions.user.permissions = new_permissions;

            axios.post('/api/user/'+this.permissions.user.id+'/permissions', { permissions: new_permissions} )
            .then(res => {
                this.global_success('Updated Permissions');
            })
            .catch(err => {
                this.axios_catch(err);
            })

      },
      editUser: function(item) {
          if (item.is_admin)
          {
              this.user.is_admin = 1;
          } else {
              this.user.is_admin = 0;
          }
          this.user.id = item.id;
          this.user.first_name = item.first_name;
          this.user.last_name = item.last_name;
          this.$bvModal.show('edit_user');
      },
      update_user: function(bvModalEvt) {
          bvModalEvt.preventDefault();
          axios.patch('/api/user/'+this.user.id, this.user)
          .then(res => {
              this.global_success('Updated User');
              this.$bvModal.hide('edit_user');
              this.getUserList();
          })
          .catch(err => {
              this.axios_catch(err);
          })
      },
      emailUser(userEmail) {
        var mailto_link = 'mailto:' + userEmail
        window = window.open(mailto_link, 'emailWindow')
        if (window && window.open && !window.closed) window.close()
      },
      deleteUser: function(id) {
        if (confirm('Are you sure you want to deactivate this user?')) {
          axios
            .delete('/api/user/' + id)
            .then(function(response) {})
            .catch(function(error) {
              alert(error)
            })
          window.$('#addModal').modal('toggle')
          this.getUserList()
        }
      },
    }
  }

</script>
