/**
 * Hamilton County Child Theme JavaScript
 */

;(function () {
	"use strict"

	// Wait for DOM to be ready
	document.addEventListener("DOMContentLoaded", function () {
		// Sticky header adjustment for WordPress admin bar and utility bar
		const header = document.querySelector(".main-navigation")
		const adminBar = document.getElementById("wpadminbar")
		const utilityBar = document.querySelector(".utility-bar")

		if (header) {
			const adjustHeaderPosition = function () {
				let topPosition = 40 // Default utility bar height (h-10 = 40px)

				if (adminBar) {
					if (window.innerWidth > 600) {
						topPosition += 32 // Admin bar desktop height
					} else {
						topPosition += 46 // Admin bar mobile height
					}
				}

				header.style.top = topPosition + "px"

				// Also adjust the utility bar if admin bar exists
				if (utilityBar && adminBar) {
					if (window.innerWidth > 600) {
						utilityBar.style.top = "32px"
					} else {
						utilityBar.style.top = "46px"
					}
				}
			}

			adjustHeaderPosition()
			window.addEventListener("resize", adjustHeaderPosition)
		}

		// Smooth scroll for anchor links
		document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
			anchor.addEventListener("click", function (e) {
				const targetId = this.getAttribute("href")
				if (targetId !== "#" && targetId !== "#0") {
					const target = document.querySelector(targetId)
					if (target) {
						e.preventDefault()
						const offsetTop =
							target.getBoundingClientRect().top +
							window.pageYOffset -
							100
						window.scrollTo({
							top: offsetTop,
							behavior: "smooth",
						})
					}
				}
			})
		})

		// Add keyboard navigation for dropdown menus
		const menuItems = document.querySelectorAll(".menu-item-has-children")
		menuItems.forEach((item) => {
			const link = item.querySelector("a")
			const submenu = item.querySelector("ul")

			if (link && submenu) {
				link.addEventListener("keydown", function (e) {
					if (e.key === "Enter" || e.key === " ") {
						e.preventDefault()
						submenu.classList.toggle("visible")
						submenu.classList.toggle("opacity-100")
					}
				})
			}
		})

		// Accessibility: Add ARIA labels for screen readers
		const searchForms = document.querySelectorAll(".search-form")
		searchForms.forEach((form) => {
			const input = form.querySelector(".search-field")
			const button = form.querySelector(".search-submit")

			if (input) {
				input.setAttribute("aria-label", "Search")
			}
			if (button) {
				button.setAttribute("aria-label", "Submit search")
			}
		})

		// Print functionality for department pages
		const printButtons = document.querySelectorAll(".print-page")
		printButtons.forEach((button) => {
			button.addEventListener("click", function () {
				window.print()
			})
		})

		// External link indicators
		const externalLinks = document.querySelectorAll('a[target="_blank"]')
		externalLinks.forEach((link) => {
			if (!link.querySelector(".fa-external-link-alt")) {
				link.setAttribute("rel", "noopener noreferrer")
				// Optionally add screen reader text
				const srText = document.createElement("span")
				srText.className = "sr-only"
				srText.textContent = " (opens in new window)"
				link.appendChild(srText)
			}
		})

		// Mobile menu close on escape key
		document.addEventListener("keydown", function (e) {
			if (e.key === "Escape") {
				// Trigger Alpine.js to close mobile menu
				const mobileMenuButton = document.querySelector("[x-data]")
				if (mobileMenuButton && typeof Alpine !== "undefined") {
					Alpine.store("mobileMenuOpen", false)
				}
			}
		})

		// Lazy loading for images (fallback for older browsers)
		if ("loading" in HTMLImageElement.prototype) {
			const images = document.querySelectorAll('img[loading="lazy"]')
			images.forEach((img) => {
				img.src = img.dataset.src || img.src
			})
		} else {
			// Fallback for browsers that don't support lazy loading
			const script = document.createElement("script")
			script.src =
				"https://cdnjs.cloudflare.com/ajax/libs/lozad.js/1.16.0/lozad.min.js"
			script.onload = function () {
				const observer = lozad()
				observer.observe()
			}
			document.body.appendChild(script)
		}
	})

	// Handle window resize for responsive adjustments
	let resizeTimer
	window.addEventListener("resize", function () {
		clearTimeout(resizeTimer)
		resizeTimer = setTimeout(function () {
			// Adjust any responsive elements if needed
			document.dispatchEvent(new Event("responsive-resize"))
		}, 250)
	})
})()
