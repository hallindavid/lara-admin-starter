<template>
    <div>
        <!-- Modal to edit user -->
        <b-modal id="edit_user" size="lg" title="Edit User" @ok="update_user" ok-title="Save">
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
                    </div> <!-- end form-group row -->

                    <div class="form-group row">
                            <label for="country" class="col-md-2 col-form-label text-md-right pr-2">Country</label>
                            <div class="col-md-4">
                                <select name="country" id="country" class="form-control" v-model="user.country">
                                    <option value="United States" selected>United States</option>
                                    <option value="Canada">Canada</option>
                                </select>
                            </div>
                            <label for="state" class="col-md-2 col-form-label text-md-right pr-2">State</label>
                            <div class="col-md-4">
                                <select name="state" id="state" class="form-control" v-model="user.state">
                                    <option value="">Select One</option>
                                    <optgroup v-if="user.country=='United States'" label="U.S. States/Territories">
                                        <option value="AK">Alaska</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DC">District of Columbia</option>
                                        <option value="DE">Delaware</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="IA">Iowa</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MD">Maryland</option>
                                        <option value="ME">Maine</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MT">Montana</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NY">New York</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VA">Virginia</option>
                                        <option value="VT">Vermont</option>
                                        <option value="WA">Washington</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WY">Wyoming</option>
                                    </optgroup>
                                    <optgroup v-else-if="user.country=='Canada'" label="Canadian Provinces">
                                        <option value="AB">Alberta</option>
                                        <option value="BC">British Columbia</option>
                                        <option value="MB">Manitoba</option>
                                        <option value="NB">New Brunswick</option>
                                        <option value="NF">Newfoundland</option>
                                        <option value="NT">Northwest Territories</option>
                                        <option value="NS">Nova Scotia</option>
                                        <option value="NU">Nunavut</option>
                                        <option value="ON">Ontario</option>
                                        <option value="PE">Prince Edward Island</option>
                                        <option value="QC">Quebec</option>
                                        <option value="SK">Saskatchewan</option>
                                        <option value="YT">Yukon Territory</option>
                                    </optgroup>
                                    <optgroup v-else>
                                        <option value="">Please Select a Country</option>
                                    </optgroup>
                                </select>
                            </div> <!-- end col-md-4 -->
                        </div> <!-- end form-group row -->
                        <div class="form-group row">
                            <label for="timezone" class="col-md-2 col-form-label text-md-right pr-2">Timezone</label>
                            <div class="col-md-4">
                                <select name="timezone" id="timezone" class="form-control" v-model="user.timezone">
                                    <option value="" selected>Select a Timezone</option>
                                    <option value="America/Anchorage" selected>Alaska Time (AKST/AKDT)</option>
                                    <option value="America/Halifax" selected>Atlantic Time (AST/ADT)</option>
                                    <option value="America/Winnipeg" selected>Central Time (CST/CDT)</option>
                                    <option value="America/Toronto" selected>Eastern Time (EST/EDT)</option>
                                    <option value="America/Adak" selected>Hawaii Time (HAST/HADT)</option>                                
                                    <option value="America/Edmonton" selected>Mountain Time (MST/MDT)</option>
                                    <option value="America/St_Johns" selected>Newfoundland Time (NST/NDT)</option>
                                    <option value="America/Vancouver" selected>Pacific Time (PST/PDT)</option>
                                </select>
                            </div>
                            <label for="is_admin" class="col-md-2 col-form-label text-md-right pr-2">Role</label>
                            <div class="col-md-4">
                                <select class="form-control" id="is_admin" v-model="user.is_admin">
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                        </div> <!-- end form-group row -->
                </div> <!-- end col-12 -->
            </div> <!-- end row -->
        </b-modal>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            user: {
                id: '',
                first_name: '',
                last_name:'',
                state: '',
                country:'',
                timezone: '',
                email: '',
                is_admin: 0,
            },
        }
    }, 
    methods: {
        edit_user: function(user) {
          if (user.is_admin)
          {
              this.user.is_admin = 1;
          } else {
              this.user.is_admin = 0;
          }
          this.user.id = user.id;
          this.user.first_name = user.first_name;
          this.user.last_name = user.last_name;
          this.user.country = user.country;
          this.user.state = user.state;
          this.user.timezone = user.timezone;
          this.$bvModal.show('edit_user');
      },
      update_user: function(bvModalEvt) {
          bvModalEvt.preventDefault();
          axios.patch('/api/admin/user/'+this.user.id, this.user)
          .then(res => {
              this.global_success('Updated User');
              this.$bvModal.hide('edit_user');
              this.$emit('updated');
          })
          .catch(err => {
              this.axios_catch(err)
          })
      },
    }
}
</script>