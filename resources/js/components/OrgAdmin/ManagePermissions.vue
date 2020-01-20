<template>
  <div>
        <b-modal 
            id="manage_permissions" 
            title="Manage Permissions"
            v-model="showModal"
            @hidden="resetModal"
            hide-footer
            >
            <table class="table">
                <tbody>
                    <tr v-for="(perm, index) in permissions" :key="index">
                        <td v-text="perm.permission_name"></td>
                        <td v-text="perm.permission_description"></td>
                        <td><b-form-checkbox v-model="perm.has_perm" switch @change="toggle_perm(perm.permission_id)"></b-form-checkbox></td>
                    </tr>
                </tbody>
            </table>
            
          
        </b-modal>
  </div>
</template>

<script>
  export default {
    //Variables/Fields
    data: function() {
      return {
        showModal: false,
        user_id: 0,
        first_name: "",
        last_name: "",
        permissions: [],
      }
    },
    methods: {
        boot: function(user_id) {
            this.showModal = true;
            this.user_id = user_id;
            let self = this;
            axios.get("/api/org/user/"+user_id)
            .then(res => {
                self.first_name = res.data.first_name;
                self.last_name = res.data.last_name;
                self.permissions = res.data.permissions;
            })
            .catch(err => {
                this.axios_catch(err);
            })
        },
        toggle_perm: function(permission_id) {
            axios.post('/api/org/user/'+this.user_id+"/toggle_permission", {
                permission_id: permission_id
            })
            .then(res=>{
                //do nothing.  it worked
            })
            .catch(err=> {
                this.axios_catch(err);
            })
        },
        resetModal: function() {
            this.user_id = 0
            this.first_name = "";
            this.last_name = "";
            this.permissions = [];
        }
    }
  }
</script>
