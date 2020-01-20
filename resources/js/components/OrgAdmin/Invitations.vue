<template>
  <div>
      <newinvitation ref="newinvitation" @invited="new_invitation"></newinvitation>
    <b-container fluid>
        <div class="row justify-content-end mb-2">
            <div class="col-lg-5">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Search for an Invitation" v-model="filter"/>
                    </div>
                    <div class="col-2">
                        <b-button variant="primary" block @click="invite"><i class="fas fa-envelope"></i> Invite</b-button>
                    </div> <!-- end div col -->
                </div> <!-- end div row -->
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
                
                
                <template v-slot:cell(actions)="data">
                    <b-button @click="delete_invitation(data.item)" variant="danger" size="xs"><i class="fas fa-fw fa-trash-alt"></i></b-button>
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
    import newinvitation from './NewInvitation.vue';

  export default {
    //Variables/Fields
    data: function() {
      return {
        fields: [
          { key: 'name', sortable: true },
          { key: 'email_address', sortable: true },
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
      this.list = JSON.parse(JSON.stringify(this.invitations));
    },
    components: {
        newinvitation
    },
    computed: {
        rows: function() {
            return this.list.length;
        }
    },
    props: {
        invitations: {
            required: true,
            type: Array
        }
    },
    methods: {
        invite: function() {
            this.$refs.newinvitation.boot();
        },
        new_invitation: function(invite) {
            this.list.push(invite);
        },
        delete_invitation: function(invitation) {
            if (confirm("Are you sure you want to delete this invitation?"))
            {
                axios.delete("/api/org/invites/"+invitation.id)
                .then(res => {
                    this.list.splice(this.list.findIndex(i => i.id == invitation.id),1);
                })
                .catch(err => {
                    this.axios_catch(err);
                })
            }
        }
    },
  }
</script>
