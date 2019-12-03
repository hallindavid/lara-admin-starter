<template>
    <div style="display:inline-block; width:100%">
        <b-button v-b-modal.add_user block variant="primary"><i class="fas fa-plus"></i> Add User</b-button>
        <vue-snotify></vue-snotify>

        <b-modal id="add_user" size="lg" title="Add User" @ok="save_user" ok-title="Add User">
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
                        <label for="email" class="col-md-2 col-form-label text-md-right pr-2">Email</label>
                        <div class="col-md-10">
                        <input type="email" class="form-control" id="email" placeholder="john.doe@gmail.com" v-model="user.email" autocomplete="off">
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

    </div>
</template>
<script>
export default {
    data: function() {
      return {
          user: {
            first_name: '',
            last_name:'',
            email: '',
            password: '',
            is_admin: 0,
          }
      }
    },
    mounted: function() {
      console.log("Add User Component Mounted");
      this.clean_user();
    },
    methods: {
        save_user: function(bvModalEvt) {
            bvModalEvt.preventDefault();
            axios.post('api/user', this.user)
            .then(res => {
                this.global_success("Saved User!");
                this.clean_user();
                this.$emit('added');
                this.$bvModal.hide('add_user');
            })
            .catch(err => {
                this.axios_catch(err);
            });
        },
        clean_user: function() {
            this.user.first_name = "";
            this.user.last_name = "";
            this.user.email = "";
            this.user.password = "";
            this.user.is_admin = 0;
        }
    }

}
</script>
