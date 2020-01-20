<template>
  <div>
        <b-modal 
            id="invite_user" 
            title="Invite User"
            v-model="showModal"
            @ok="send_invite"
            ok-title="Send Invite"
            :busy="busy"
            >
            
            <div class="form-group">
              <label for="name">Name</label>
                <input required type="text" class="form-control" v-model="name" id="name"/>
            </div>

            <div class="form-group">
              <label for="email_address">Email Address</label>
                <input required type="email" class="form-control" v-model="email_address" id="email_address"/>
            </div>

        </b-modal>
  </div>
</template>

<script>
  export default {
    //Variables/Fields
    data: function() {
      return {
        busy: false,
        showModal: false,
        name: "",
        email_address: "",
      }
    },
    methods: {
        boot: function() {
            this.showModal = true;
            this.resetModal();
        },
        send_invite: function(bvEvent) {
            bvEvent.preventDefault();
            this.busy = true;
            let self = this;
            axios.post('/api/org/user/send_invite', {
                name: self.name,
                email_address: self.email_address
            })
            .then(res=>{
                this.global_success("Invitation Sent");
                this.showModal = false;
                this.$emit('invited',res.data);
            })
            .catch(err=> {
                this.busy = false;
                this.axios_catch(err);
            })

        },
        resetModal: function() {
            this.name = "";
            this.email_address = "";
        }
    }
  }
</script>
