window.onload = () => {
	let qg_team_slider_modal_admin = document.getElementById('qg_team_slider_modal_admin');
	qg_team_slider_modal_admin.style.display = 'initial';

	// vue components
	const { createApp } = Vue
	const { createVuetify } = Vuetify

	const vuetify = createVuetify();

	const app = createApp({
		data() {
			return {
				test: "Hello world",
			}
		}
	});

	app.component('team_slider_modal', {
		template: "#qg-tsm-new-member",
		data() {
			return {
				dialog: false,
				loading: false,
				error: "",
				success: "",
				formObj: {
					full_name: null,
					position: null,
					image: [],
					bio: ""
				},
			}
		}, methods: {
			async newMember() {
				this.loading = true;

				if (!this.formObj.full_name || !this.formObj.position || this.formObj.image == [] || !this.formObj.bio) {
					this.loading = false;
					return this.error = "Please all fields are required"
				}

				let formdata = new FormData
				formdata.append("full_name", this.formObj.full_name);
				formdata.append("position", this.formObj.position);
				formdata.append("bio", this.formObj.bio);
				formdata.append("image", this.formObj.image[0])

				let res = await axios({
					method: 'post',
					url: '/wp-json/tsm/v1/new',
					data: formdata,
					responseType: 'json',
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				}).then(async function (res) {
					return res.data
				}).catch((e) => {
					if (e.response?.data) {
						return e.response.data.message
					}
				})

				if (res == "success") {
					this.success = "New member added successfully"
					setTimeout(() => {
						this.closeModal()
						window.location.reload()
					}, 1500)
				} else {
					this.error = res
					this.loading = false
				}
			},
			closeModal() {
				this.loading = false;
				this.error = "";
				this.formObj = {
					full_name: null,
					position: null,
					image: [],
					bio: ""
				};
				this.dialog = false;
			}
		}
	})

	app.component('edit-team-modal', {
		template: '#qg-tsm-edit-member',
		props: {
			id: "",
			full_name: "",
			position: "",
			bio: "",
			image: []
		}, data() {
			return {
				dialog: false,
				error: "",
				success: "",
				formObj: {
					full_name: this.full_name,
					position: this.position,
					image: [],
					bio: this.bio
				},
				loading: false
			}
		}, methods: {
			async editMember() {
				this.error = "";
				if (!this.formObj.full_name || !this.formObj.position || !this.formObj.bio) {
					this.loading = false;
					return this.error = "Please all fields are required (except image)"
				}

				let formdata = new FormData
				formdata.append("full_name", this.formObj.full_name);
				formdata.append("position", this.formObj.position);
				formdata.append("bio", this.formObj.bio);
				formdata.append("id", this.id);
				
				if (this.formObj.image[0]) {
					formdata.append("image", this.formObj.image[0])
				}

				let res = await axios({
					method: 'post',
					url: '/wp-json/tsm/v1/edit',
					data: formdata,
					responseType: 'json',
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				}).then(async function (res) {
					return res.data
				}).catch((e) => {
					if (e.response?.data) {
						return e.response.data.message
					}
				})

				if (res == "success") {
					this.success = "Member data edited successfully"
					setTimeout(() => {
						this.closeModal()
						window.location.reload()
					}, 1500)
				} else {
					this.error = res
					this.loading = false
				}
			},
			closeModal() {
				this.loading = false;
				this.error = "";
				this.formObj = {
					full_name: this.full_name,
					position: this.position,
					image: [],
					bio: this.bio
				};
				this.dialog = false;
			}
		}
	})

	app.use(vuetify).mount('#qg_team_slider_modal_admin')
}