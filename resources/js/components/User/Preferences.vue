<template>
    <div>
        <div class="card">
            <div class="card-header">
                <strong>Demographic Information</strong>
            </div>
            <div class="card-body">
                 
                 <div class="form-group row">
                    <label for="timezone" class="col-4 col-form-label text-right">Timezone</label>
                    <div class="col-6">
                        <select name="timezone" id="timezone" class="form-control" v-model="timezone">
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
                </div>

                <div class="form-group row">
                    <label for="country" class="col-4 col-form-label text-right">Country</label>
                    <div class="col-6">
                        <select id="country" class="form-control" v-model="country">
                            <option value="United States" selected>United States</option>
                            <option value="Canada">Canada</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="state" class="col-4 col-form-label text-right">State/Province</label>
                    <div class="col-6">
                        <select id="state" class="form-control" v-model="state">
                            <option value="">Select One</option>
                            <optgroup v-if="country=='United States'" label="U.S. States/Territories">
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
                            <optgroup v-else-if="country=='Canada'" label="Canadian Provinces">
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
                <div class="row">
                    <div class="col-6 offset-4">
                        <button class="btn btn-primary" @click="save_preferences"><i class="fa fa-save"></i> Save Preferences</button>
                    </div>
                </div>

            </div>
        </div>
        <vue-snotify></vue-snotify>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            timezone: "",
            country: "",
            state: "",
        }
    },
    props: {
        user: {
            required:true,
        },
        redirect: {
            required:false,
        },
    },
    mounted() {
        console.log('Preferences Mounted');
        this.timezone = this.user.timezone;
        this.country = this.user.country;
        this.state = this.user.state;
    },
    methods: {
        save_preferences: function() {
            axios.post('/api/update_preferences', {
                timezone:this.timezone,
                country: this.country,
                state: this.state
            })
            .then(res=>{
                this.global_success("Saved!", "Preferences Updated");
                if (this.redirect == "1")
                {
                    window.location="/";
                }
            })
            .catch(err=>{
                this.axios_catch(err);
            });
        }
    }
}
</script>