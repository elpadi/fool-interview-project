class CompanyInfo {

	static getCurrencySymbol() {
		if (('HEADERS' in APP_CONFIG) && ('Accept-Language' in APP_CONFIG.HEADERS)) {
			if (APP_CONFIG.HEADERS['Accept-Language'].indexOf('en-US') == 0) {
				return '$';
			}
		}
		return '$';
	}

	static formatValue(val, f) {
		const cur = this.getCurrencySymbol();
		switch (f) {
			case 'url': return `<a href="${val}" target="_blank">${val}</a>`;
			case 'money': return cur + val;
			case 'money-range': return cur + val.replace(/([^0-9.,])([0-9]+)/g, '$1' + (cur == '$' ? '$$' : cur) + '$2');
		}
		return val;
	}

	constructor(stockSymbol) {
		this.stockSymbol = (stockSymbol.indexOf(':') ? stockSymbol.split(':').pop() : stockSymbol).trim().toUpperCase();
	}

	getProfile() {
		if (('DEBUG' in APP_CONFIG) && Number(APP_CONFIG.DEBUG)) {
			return Promise.resolve({
				"symbol" : "AAPL",
				"profile" : {
					"price" : 318.73,
					"beta" : "1.228499",
					"volAvg" : "26604166",
					"mktCap" : "1.39732202E12",
					"lastDiv" : "2.92",
					"range" : "151.7-318.74",
					"changes" : 3.49,
					"changesPercentage" : "(+1.11%)",
					"companyName" : "Apple Inc.",
					"exchange" : "Nasdaq Global Select",
					"industry" : "Computer Hardware",
					"website" : "http://www.apple.com",
					"description" : "Apple Inc is designs, manufactures and markets mobile communication and media devices and personal computers, and sells a variety of related software, services, accessories, networking solutions and third-party digital content and applications.",
					"ceo" : "Timothy D. Cook",
					"sector" : "Technology",
					"image" : "https://financialmodelingprep.com/images-New-jpg/AAPL.jpg"
				}
			});
		}
		if ('STOCK_COMPANY_INFO' in window) return Promise.resolve(window.STOCK_COMPANY_INFO);
		return window.fetch(`https://financialmodelingprep.com/api/v3/company/profile/${this.stockSymbol}`).then(resp => resp.json());
	}

	getPrice() {
		if (('DEBUG' in APP_CONFIG) && Number(APP_CONFIG.DEBUG)) {
			return Promise.resolve({
				"symbol" : "AAPL",
				"price" : 318.68
			});
		}
		return window.fetch(`https://financialmodelingprep.com/api/v3/stock/real-time-price/${this.stockSymbol}`).then(resp => resp.json());
	}

	fill(container) {
		console.log('CompanyInfo.fill', container, this);
		this.getProfile().then(data => {

			if (!('lastDiv' in data.profile)) data.profile.lastDiv = 'N/A';

			if (container.dataset.infoType == 'profile') {
				container.querySelector('header').insertAdjacentHTML('afterbegin', `<img src="${data.profile.image}" alt="">`);
			}

			Array.from(container.querySelectorAll(`.company-info__field`)).forEach(node => {
				let key = node.dataset.key;
				if (key && (key in data.profile)) {
					node.innerHTML = node.dataset.format ? this.constructor.formatValue(data.profile[key], node.dataset.format) : data.profile[key];
				}
			});

		});
	}

}

(function() {

	window.addEventListener('load', function() {

		Array.from(document.querySelectorAll('.financial-widgets .company-info')).forEach(node => {
			(new CompanyInfo(node.dataset.stockSymbol)).fill(node);
		});

	});

})();
