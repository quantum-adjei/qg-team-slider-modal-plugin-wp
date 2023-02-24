window.onload = () => {
	let qg_team_slider_modal = document.getElementById('qg_team_slider_modal');
	qg_team_slider_modal.style.display = 'initial';

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
		template: "#qg-tsm-popup-component",
		data(){
			return {
				dialog: false,
				formObj: {
					full_name: null,
					position: null,
					image: [],
					bio: []
				},
				number0fBio: 1
			}
		}, methods: {
			async newMember() {
				print("hello world")
			}
		}
	})

	app.use(vuetify).mount('#qg_team_slider_modal')
}