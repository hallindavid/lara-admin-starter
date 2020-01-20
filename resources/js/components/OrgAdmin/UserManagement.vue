<template>
  <div>
    <vue-snotify></vue-snotify>
    <div class="card">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a class="nav-link" href="#" v-bind:class="{ active: page == 'users' }" @click="page='users'">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" v-bind:class="{ active: page == 'invitations' }" @click="page='invitations'">Invitations</a>
          </li>
        </ul>
      </div>
      <div class="card-body" v-if="page=='users'">
        <userlist v-bind:users="this.users"></userlist>
      </div>
      <div class="card-body" v-if="page=='invitations'">
        <invitations v-bind:invitations="this.invitations"></invitations>
      </div>
    </div>


      
  </div>
</template>

<script>
import userlist from './UserList.vue';
import invitations from './Invitations.vue';

  export default {
    //Variables/Fields
    data: function() {
      return {
        page: "users"
        
      }
    },
    //When loaded, call get_user_list
    mounted: function() {
      
    },
    components: {
      userlist,
      invitations
    },
    computed: {
    },
    props: {
      users: {
          required: true,
          type: Array
      },
      invitations: {
          required: true,
          type: Array
      }
    },
    methods: {
    }
  }
</script>
