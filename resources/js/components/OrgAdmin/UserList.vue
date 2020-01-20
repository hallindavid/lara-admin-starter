<template>
  <div>
    <managePermisions ref="managePermisions"></managePermisions>
    <b-container fluid>
        <div class="row justify-content-end mb-2">
            <div class="col-lg-4">
                <input type="text" class="form-control" placeholder="Search for a User" v-model="filter"/>
            </div> <!-- end div col lg -->
        </div> <!-- end div row -->
      <!-- b-row for table -->
      <b-row> 
        <div class="col-sm-12">
          <div class="table-responsive"> 
            <b-table id="table"
                    show-empty
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
                <template v-slot:cell(actions)="data">
                    <b-button v-b-tooltip.hover placement="top" title="Manage permissions" @click="manage_permissions(data.item.id)" variant="primary" size="xs"><i class="fas fa-lock fa-fw"></i></b-button>
                    <b-button v-b-tooltip.hover placement="top" title="Remove user" @click="remove_user_from_org(data.item.id)" variant="danger" size="xs"><i class="fas fa-fw fa-trash-alt"></i></b-button>
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
import managePermisions from './ManagePermissions.vue';

  export default {
    //Variables/Fields
    data: function() {
      return {
        fields: [
          { key: 'name', sortable: true },
          { key: 'email', sortable: true },
          { key: 'actions', label:'Actions'},
        ],
        perPage: 20,
        currentPage: 1,
        filter: null,
        list: [],
      }
    },
    //When loaded, call get_user_list
    mounted: function() {
      this.list = JSON.parse(JSON.stringify(this.users));
    },
    components: {
      managePermisions
    },
    computed: {
        rows: function() {
            return this.list.length;
        }
    },
    props: {
        users: {
            required: true,
            type: Array
        }
    },
    methods: {
      manage_permissions: function(user_id) {
        this.$refs.managePermisions.boot(user_id);
      },
      remove_user_from_org: function(user_id) {
        if (confirm("Are you sure you want to remove this user from the organization?"))
        {
           axios.delete("/api/org/user/"+user_id)
           .then(res => {
             this.global_success("Removed");
             this.list.splice(this.list.findIndex(p => p.id == user_id), 1);
           })
           .catch(err => {
             this.axios_catch(err);
           })
        }
      },      
    },
  }
</script>
