<template>
        <div class="row">
            <div v-bind:class="main_col_width">
                <div class="card">
                    <vue-snotify></vue-snotify>
                    <div class="card-header">
                    <h3 class="card-title">Update Current Organization</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <b-table id="table"
                                class="table table-striped table-hover"
                                :per-page="perPage"
                                :fields="fields"
                                :items="list"
                                :current-page="currentPage"
                                :filter="filter">
                            <template v-slot:cell(change)="data">
                                <template v-if="data.item.current">
                                    <b-form-radio size="sm" name="current_organization" button button-variant="success" required>Active </b-form-radio>
                                </template>
                                <template v-else>
                                    <b-button size="sm" name="current_organization" @click="switch_organization(data.item.id)" required>
                                        Switch
                                    </b-button>
                                </template>
                            </template>
                            <template v-slot:cell(owner)="data">
                                <span>{{ data.item.owner_first_name + " " + data.item.owner_last_name }}</span>
                            </template>
                            <template v-slot:cell(leave)="data">
                                <template v-if="data.item.current">
                                    <b-button size="sm" name="current_organization" variant="danger" @click="leave_organization(data.item.id)" required>
                                        <i class="fas fa-sign-out-alt"></i> Leave
                                    </b-button>
                                </template>
                            </template>
                        </b-table>
                    </div>
                    <b-pagination v-model="currentPage"
                                    align="fill"
                                    :total-rows="rows"
                                    :per-page="perPage"
                                    aria-controls="table"
                                    :filter="filter"
                                    >
                    </b-pagination>
                    <!-- /.card-body -->
                </div><!-- /.card -->
            </div> <!-- col-12 or col-9 -->
            <div class="col-sm-3" v-show="invitation_list.length > 0">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Invitations</h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li v-for="(invite, index) in invitation_list" v-bind:key="index" class="list-group-item">
                            <b-button @click="decline_invite(invite.invitation_id)" variant="danger" size="sm" class="float-right"  v-b-tooltip.hover title="Decline Invitation">
                                <i class="fas fa-times fa-fw"></i>
                            </b-button>
                            <b-button @click="accept_invite(invite.invitation_id)" variant="success" size="sm" class="float-right mx-1"  v-b-tooltip.hover title="Accept Invitation">
                                <i class="fas fa-check fa-fw"></i>
                            </b-button>  
                            {{ invite.org_name }} 
                            <br />
                            <small class="text-muted">on {{ invite.created_at }}</small>
                        </li>
                    </ul>
                </div>
            </div> <!-- end of col-sm-3 -->
        </div><!-- /row -->
</template>

<script>
export default {

    data: function() {
      return {
        fields: [
          { key: 'name', label:'Organization'},
          { key: 'owner', label:'Org. Admin'},
          { key: 'change',label:'Change'},
          { key: 'Leave'}
        ],
        perPage: 10,
        currentPage: 1,
        filter: null,
        list: [],
        invitation_list: [],
      }
    },
    computed: {
      rows() {
        return this.list.length
      },
      main_col_width() {
            if (this.invitation_list.length == 0)
            {
                return "col-sm-12";
            } else {
                return "col-sm-9";
            }
        }
    },
     props: {
        org_list: {
            required:true,
            type: Array
        },
        invitations: {
            required:true,
            type: Array
        }
    },
    mounted: function() {
      this.list = this.org_list;
      this.invitation_list = this.invitations;
    },
    methods: {
        decline_invite: function(invite_id) {
            axios.patch('/api/decline_invitation/'+invite_id)
            .then(res=>{
                this.invitation_list.splice(this.invitation_list.findIndex(i => i.invitation_id == invite_id), 1);
                this.global_success("Invitation Declined");
            })  
            .catch(err=>{
                this.axios_catch(err);
            })
        },
        accept_invite: function(invite_id) {
            axios.patch('/api/accept_invitation/'+invite_id)
            .then(res=>{
                this.invitation_list.splice(this.invitation_list.findIndex(i => i.invitation_id == invite_id), 1);
                this.list.push(res.data.data);
            })  
            .catch(err=>{
                this.axios_catch(err);
            })
        },
        switch_organization: function(org_id) {
            axios.post('/api/switch-organization', {
                organization_id : org_id
            })
            .then(res => {
                this.global_success("Setting Updated");
                this.list[this.list.findIndex(o => o.current == true)].current = false;
                this.list[this.list.findIndex(o => o.id == org_id)].current = true;
            })
            .catch(err => {
                this.axios_catch(err);
            });
        },
        leave_organization: function(org_id){
            if (confirm('Are you sure you want to leave this organization?')) {
                axios.delete('api/leave-organization/'+org_id)
                .then(response => {
                    console.log(response);
                    if (response.data.status)
                    {
                        this.global_success('Success',response.data.message)
                    } else {
                        this.global_error('Error',response.data.message);
                    }
                    this.get_my_organizations();
                })
                .catch(err=> {
                    this.axios_catch(err)
                })
            }
        },
    }

}
</script>
