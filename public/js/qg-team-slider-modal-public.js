window.onload = () => {
	let qg_team_slider_modal_public = document.getElementById('qg_team_slider_modal_public');
	qg_team_slider_modal_public.style.display = 'initial';

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

	app.component('team-view-popup', {
		template: "#qs-tsm-view-popup",
		props: {
			image_url: '',
			bio: '',
			position: '',
			full_name: ''
		},
		data() {
			return {
				dialog: false,
			}
		},
	})

	app.use(vuetify).mount('#qg_team_slider_modal_public');


	// swiperjs configure
	let mySwiper = new Swiper('.qg-tsm-swiper', {
		loop: false,
		slidesPerView: 4,
		// spaceBetween: 10,
		navigation: {
		  nextEl: ".swiper-button-next",
		  prevEl: ".swiper-button-prev",
		}, breakpoints: {
		  "@0.00": {
			slidesPerView: 1,
			spaceBetween: 10,
		  },
		  "@0.75": {
			slidesPerView: 2,
			spaceBetween: 20,
		  },
		  "@1.00": {
			slidesPerView: 3,
			spaceBetween: 20,
		  },
		  "@1.50": {
			slidesPerView: 4,
			spaceBetween: 20,
		  },
		},
	  });
}