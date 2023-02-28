<template id="qg-tsm-new-member">
    <v-btn size="small" class="font-weight-medium" @click="dialog = true" color="#681A55" variant="outlined"
        elevation="0">
        New Member
    </v-btn>

    <v-dialog v-model="dialog" transition="dialog-top-transition" persistent max-width="700px" scrollable>
        <v-card>
            <v-toolbar title="New member" density="compact">
                <v-spacer></v-spacer>
                <v-toolbar-items>
                    <v-btn v-if="!loading" icon dark @click="closeModal">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </v-toolbar-items>
            </v-toolbar>
            <v-card-text>
                <p v-if="error" class="text-body-1 font-weight-medium text-error text-center mb-2">{{ error }}</p>
                <p v-if="success" class="text-body-1 font-weight-medium text-success text-center mb-2">{{ success }}</p>
                <v-form @submit.prevent="newMember" class="mb-3">
                    <v-row justify="center">
                        <v-col cols="12" md="6">
                            <v-text-field density="compact" variant="outlined" v-model="formObj.full_name"
                                label="Full Name" hide-details="true">
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field density="compact" variant="outlined" v-model="formObj.position"
                                label="Position" hide-details="true">
                            </v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-file-input density="compact" label="Member Image" v-model="formObj.image"
                                variant="outlined" hide-details="true" prepend-icon="mdi-camera"></v-file-input>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea v-model="formObj.bio" label="Bio" variant="outlined"
                                hide-details="true"></v-textarea>
                        </v-col>
                        <v-col cols="4">
                            <v-btn color="#681A55" class="text-white font-weight-medium" block type="submit"
                                :loading="loading">Submit</v-btn>
                        </v-col>

                    </v-row>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>