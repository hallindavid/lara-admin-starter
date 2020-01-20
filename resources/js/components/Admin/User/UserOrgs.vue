<template>
     <!-- Modal to edit user organizations -->
    <b-modal id="user_organizations" size="lg" title="User Organizations" ok-title="Save"  cancel-title="Cancel">
        <b-table id="organizationsTable"
                    class="table table-striped table-bordered table-hover"
                    :per-page="organizations.perPage"
                    :fields="organizations.fields"
                    :items="organizations.list"
                    :current-page="organizations.currentPage"
                    :sort-by="organizations.sortBy">
            <template v-slot:cell(permissions)="data">
                <template v-for="perm in data.value">
                  {{perm.title}} 
                </template>
            </template>
        </b-table>
    </b-modal>
</template>
<script>
export default {
    data: function(){
         return {
            user_id: null,
            user_first_name: "",
            user_last_name: "",
            organizations: {
                list: [],
                per_page: 15,
                currentPage:1,
                sortBy:'title',
                fields: [
                    { key:'id', label: 'Organization ID'},
                    { key: 'name', label:'Organization Name'},
                ]
            }
         }
    },
    methods:{
        set_info: function(user_id){
            this.user_id = user_id;
            axios.get('/api/admin/user/'+user_id+"/organizations")
            .then(res=>{
                this.organizations.list = res.data;
                this.$bvModal.show('user_organizations');
            })
            .catch(err=>{
                this.axios_catch(err);
            })
        },
    }
}
</script>