/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		"./**/*.php",
		"./src/**/*.js",
		"./template-parts/**/*.php",
		"../bd-basetheme-2023/template-parts/**/*.php",
	],
	theme: {
		extend: {
			colors: {
				"hamco-green": "#006735",
				"navy-dark": "#0d1b2a",
				"blue-gray-light": "#e8f4f8",
				green: {
					50: "#e6f2eb",
					100: "#cce5d7",
					200: "#99cbae",
					300: "#66b186",
					400: "#33975d",
					500: "#007d35",
					600: "#006735",
					700: "#005129",
					800: "#003b1d",
					900: "#002511",
				},
				gray: {
					50: "#f9fafb",
					100: "#f3f4f6",
					200: "#e5e7eb",
					300: "#d1d5db",
					400: "#9ca3af",
					500: "#6b7280",
					600: "#4b5563",
					700: "#374151",
					800: "#1f2937",
					900: "#111827",
				},
			},
			fontFamily: {
				sans: [
					"Inter",
					"system-ui",
					"-apple-system",
					"BlinkMacSystemFont",
					"Segoe UI",
					"Roboto",
					"Helvetica Neue",
					"Arial",
					"sans-serif",
				],
				serif: [
					"Georgia",
					"Cambria",
					"Times New Roman",
					"Times",
					"serif",
				],
				mono: [
					"Monaco",
					"Consolas",
					"Liberation Mono",
					"Courier New",
					"monospace",
				],
			},
			spacing: {
				18: "4.5rem",
				88: "22rem",
				100: "25rem",
				120: "30rem",
			},
			animation: {
				"fade-in": "fadeIn 0.5s ease-in-out",
				"fade-in-up": "fadeInUp 0.6s ease-out",
				"slide-in-right": "slideInRight 0.5s ease-out",
				"slide-in-left": "slideInLeft 0.5s ease-out",
			},
			keyframes: {
				fadeIn: {
					"0%": { opacity: "0" },
					"100%": { opacity: "1" },
				},
				fadeInUp: {
					"0%": {
						opacity: "0",
						transform: "translateY(20px)",
					},
					"100%": {
						opacity: "1",
						transform: "translateY(0)",
					},
				},
				slideInRight: {
					"0%": {
						opacity: "0",
						transform: "translateX(-100%)",
					},
					"100%": {
						opacity: "1",
						transform: "translateX(0)",
					},
				},
				slideInLeft: {
					"0%": {
						opacity: "0",
						transform: "translateX(100%)",
					},
					"100%": {
						opacity: "1",
						transform: "translateX(0)",
					},
				},
			},
			screens: {
				xs: "475px",
				"3xl": "1920px",
			},
			transitionDuration: {
				400: "400ms",
			},
		},
	},
	safelist: [
		"bg-hamco-green",
		"text-hamco-green",
		"border-hamco-green",
		"bg-navy-dark",
		"bg-blue-gray-light",
		"hover:bg-green-800",
		"hover:text-hamco-green",
		"animate-fade-in-up",
		"animation-delay-200",
		"animation-delay-400",
	],
	plugins: [
		require("@tailwindcss/typography"),
		require("@tailwindcss/forms"),
		require("@tailwindcss/aspect-ratio"),
	],
}
