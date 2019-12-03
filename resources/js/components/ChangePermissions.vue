<template>
    <span>
        <b-button v-b-modal.permissions variant="success" size="xs"><i class="fas fa-user-shield"></i></b-button>
        <b-modal id="permissions" size="lg" title="Permissions" >
            <b-table id="permissionsTable"
                     class="table table-striped table-bordered table-hover"
                     :per-page="perPage"
                     :fields="fields"
                     :items="permissions"
                     :current-page="currentPage"
                     :sort-by="sortBy">
                <template v-slot:cell(checked)="data">
                       <b-form-checkbox size="lg" checked v-model="data.item.checked" @change="updatePermission"></b-form-checkbox>
                </template>
            </b-table>
            <template v-slot:modal-footer>
                <button type="button" class="btn btn-danger" @click="getPermissionsList"><i class="fas fa-trash-alt"></i> Discard Changes</button>
                <button type="button" class="btn btn-primary" @click="savePermissions"><i class="fas fa-pencil-alt"></i> Assign Permissions</button>
            </template>
        </b-modal>
    </span>
</template>
<script>
export default {
    data: function(){
        return {
            user_id:'330490d8-d7d5-4cfc-93c1-310deeec3767',
            perPage:15,
            fields:[
                    { key: 'title', sortable: true },
                    { key: 'description', label:'Description', sortable: true },
                    { key: 'checked', label:'Checked', sortable: true },
                ],
            permissions:[],
            currentPage:1,
            sortBy:'title',
        }
    },
    mounted: function(){
        this.getPermissionsList()
    },
    methods: {
        getPermissionsList(){
            axios.post('api/userpermissions', user_id)
            .then((res)=>{
                console.log(res.data)
                this.permissions = res.data
            })
        },
        updatePermission(value){
            if(value==1){
                value = 0;
            }
            else if(value==0){
                value = 1;
            }
        },
        savePermissions(){

        }
    }
}
</script>
