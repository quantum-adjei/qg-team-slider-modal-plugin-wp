<template id="qs-tsm-view-popup">
    <v-dialog v-model="dialog" :scrim="false" transition="dialog-bottom-transition" max-width="900px">
        <template v-slot:activator="{ props }">
            <v-card class="mx-auto my-2" width="270px" elevation="1" outlined v-bind="props">
                <v-img :src="image_url" height="250px"></v-img>

                <v-card-title class="text-center text-subtitle-1 text-uppercase pb-0">
                    {{ full_name }}
                </v-card-title>

                <v-card-subtitle class="text-center text-capitalize text-subtitle-1 pb-3">
                    {{ position }}
                </v-card-subtitle>
            </v-card>
        </template>
        <v-card>
            <v-toolbar density="compact">
                <v-spacer></v-spacer>
                <v-toolbar-items>
                    <v-btn icon dark @click="dialog = false">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </v-toolbar-items>
            </v-toolbar>
            <v-row class="my-5 px-4">
                <v-col cols="12" md="4">
                    <v-img class="mx-auto" :src="image_url" height="320px" width="270px" cover :aspect-ratio="1"></v-img>
                </v-col>
                <v-col cols="12" md="8">
                    <div class="text-center text-md-left">
                        <p class="text-body-2 text-uppercase font-weight-bold pb-1">
                            {{ position }}
                        </p>
                        <p class="text-h5 text-uppercase font-weight-bold pb-2">
                            {{ full_name }}
                        </p>

                        <hr class="md_hd_udl mb-2" />
                    </div>

                    <div class="mb-5 text-justify pre-formatted">
                        {{ bio }}
                    </div>
                </v-col>
            </v-row>
        </v-card>
    </v-dialog>
</template>

<style>
    .md_hd_udl {
        width: 100px;
    }

    .pre-formatted {
        white-space: pre-wrap;
    }
</style>