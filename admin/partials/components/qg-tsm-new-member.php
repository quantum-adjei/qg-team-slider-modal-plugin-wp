<template id="qg-tsm-popup-component">
    <v-btn size="small" class="font-weight-bold" @click="dialog = true" elevation="1">
        New Member
    </v-btn>

    <v-dialog v-model="dialog" transition="dialog-top-transition" persistent max-width="700px" scrollable>
        <v-card>
            <v-toolbar title="New member" density="compact">
                <v-spacer></v-spacer>
                <v-toolbar-items>
                    <v-btn icon dark @click="dialog = false">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </v-toolbar-items>
            </v-toolbar>
            <v-card-text>
                <v-form @submit.prevent="newMember">
                    <v-row justify="start">
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
                        <v-col cols="12" md="6">
                            <v-text-field density="compact" variant="outlined" v-model="formObj.image" label="Image"
                                required>
                            </v-text-field>
                        </v-col>
                        
                    </v-row>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>