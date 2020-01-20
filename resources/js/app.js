
require('./bootstrap');
window.Vue = require('vue');



import Vue from 'vue'

import Snotify from 'vue-snotify'; // 1. Import Snotify
Vue.use(Snotify, {
    toast: {
        timeout: 4000
    }
});

import BootstrapVue from 'bootstrap-vue'
  Vue.use(BootstrapVue)


  Vue.use(require('vue-moment'));
  
// Vue.prototype.$userID = document.querySelector("meta[name='user-id']").getAttribute('content');
// Vue.prototype.$userEmail = document.querySelector("meta[name='user-email']").getAttribute('content');

Vue.mixin({
	methods: {
        global_success(title, body) {
            this.$snotify.success(body,title);
        },
        axios_catch(error) {
            console.log("Axios Catch called for error");
            console.log(error);
            if (error.response.status == 422)
            {
                var errors = error.response.data.errors;
                if (Object.keys(errors).length > 0) {
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            console.log(key + " -> " + errors[key]);
                            this.global_error("Invalid Entry",errors[key][0]);
                        }
                    }
                }
            } else {
                console.error(error);
                self.$snotify.error("Error!", error.response.statusText);
            }
        },
		global_error:function(title, body) {
            this.$snotify.error(body,title);
        },
        global_warning:function(title, body) {
            this.$snotify.warning(body,title);
        },
        checkChanged: function(current,original) {
            var v1 = "";
            var v2 = "";
            if (current)
            {
              v1 = current;
            }
            if (original)
            {
              v2 = original;
            }
            return (!(v1 == v2));
        },
	}
  });


  Vue.component('admin-users', require('./components/Admin/User/Users.vue').default);
  Vue.component('admin-organizations', require('./components/Admin/Organizations.vue').default);
  
  Vue.component('create-organization', require('./components/CreateOrganization.vue').default);
  Vue.component('change-organization', require('./components/ChangeOrganization.vue').default);

  Vue.component('org-user-management', require('./components/OrgAdmin/UserManagement.vue').default);
  
  Vue.component('user-preferences', require('./components/User/Preferences.vue').default);


const app = new Vue({
  el: '#app'
});
