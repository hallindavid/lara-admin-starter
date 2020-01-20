<template>
    <div class="card">
        <div class="card-body">
            <vue-snotify></vue-snotify>
            <form-wizard @on-complete="save_organization" :title="page_title" color="blue" subtitle="">
                <tab-content title="Organization Details" icon="fas fa-sitemap">
                    <div class="row mb-2">
                        <div class="col">
                            <input class="form-control form-control-lg" type="text" placeholder="Organization Name" v-model="new_org.name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" v-model="new_org.address" id="address" placeholder="1 Address Street" class="form-control"/>
                        </div>
                        <div class="col">
                            <input type="text" v-model="new_org.city" id="city" placeholder="City" class="form-control"/>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <select v-model="new_org.country" class="form-control" required @change="new_org.state=''">
                                    <option selected disabled value="">Select Country</option>
                                    <option value="USA">U.S.A.</option>
                                    <option value="Canada">Canada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <select v-model="new_org.state" class="form-control" required>
                                    <template v-if="new_org.country == 'USA'">
                                        <option disabled selected value="">Select State</option>
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
                                    </template>
                                    <template v-else-if="new_org.country == 'Canada'">
                                        <option disabled selected value="">Select Province</option>
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
                                    </template>
                                    <template v-else>
                                        <option disabled selected value="">Choose Country First</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <select v-model="new_org.timezone" class="form-control">
                                    <option value="" selected>Timezone</option>
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
                        </div>
                    </div>
                </tab-content>
                <tab-content title="Finish" icon="fas fa-check">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <template v-if="new_org.name.length">
                                <p>Creating a new Organization named <h5 v-text="new_org.name"></h5></p>
                            

                                <template v-if="demographics_filled_in">
                                    <p>Headquarters for {{ new_org.name }} is <strong v-text="new_org.address"></strong>, in <strong v-text="new_org.city"></strong>, <strong v-text="new_org.state"></strong></p>
                                </template>
                                <template v-else>
                                    <p>Please go back and ensure all the demographic information for the new organization is filled out</p>
                                </template>

                            </template>
                            <template v-else>
                                <p>Please go back and make sure you have filled in all the required fields</p>
                            </template>
                        </div>
                    </div>
                </tab-content>
            </form-wizard>
        </div>
    </div>
</template>

<script>
//local registration
import {FormWizard, TabContent} from 'vue-form-wizard';
import 'vue-form-wizard/dist/vue-form-wizard.min.css';
//component code
export default {
    data: function() {
      return {
        perPage: 10,
        currentPage: 1,
        filter: null,
        list: [],
        new_org: {
            name:'',
            address:"",
            city:"",
            country:"",
            state:"",
            timezone:"",
        },
      }
    },
    components: {
        FormWizard,
        TabContent
    },
    computed: {
      rows() {
        return this.list.length
      },
      page_title() {
          if (this.new_org.name.length > 0)
          {
              return 'Creating: '+this.new_org.name;
          } else {
              return 'Create a New Organization';
          }
      },
      demographics_filled_in() {
            let org = this.new_org;
            if ((org.address.length > 0) && (org.city.length > 0) && (org.state.length > 0) && (org.country.length > 0))
            {
                return true;
            }
            return false;
      }
    },
    props: ['user'],
    methods: {
        save_organization: function() {
            let self = this;
            axios.post('api/store-organization', this.new_org)
            .then(res => {
                this.global_success("Saved Organization!");
                window.location.href = 'change_org';
            })
            .catch(err => {
                this.axios_catch(err);
            })
            .finally(val=>{
                //window.location.href = "/";
            });
        },
    }

}
</script>
