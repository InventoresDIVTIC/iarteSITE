const cacheversion = 'RBarbPortv1';
filesToCache = [
	'index.html',
	'css/styles.css',
	'img/android-chrome-192x192.png',
	'img/android-chrome-512x512.png',
	'img/apple-touch-icon.png',
    'img/favicon-16x16.png',
    'img/favicon-32x32.png',
    'img/favicon.ico',
    'manifest.json',
    'serviceWorker.js',
	'img/resources/posx.jpg',
    'img/resources/negx.jpg',
    'img/resources/posy.jpg',
    'img/resources/negy.jpg',
    'img/resources/posz.jpg',
    'img/resources/negz.jpg',
	'https://unpkg.com/es-module-shims@1.6.3/dist/es-module-shims.js',
	'https://cdn.jsdelivr.net/npm/three@0.154.0/build/three.module.min.js',
	'https://cdn.jsdelivr.net/npm/three@0.154.0/examples/jsm/controls/OrbitControls.js'
]

self.addEventListener('install', event => {
	//console.log('Service worker install event fired!');
	event.waitUntil(
		caches.open(cacheversion).then(cache => {
			return cache.addAll(filesToCache);
		})
	);
});

self.addEventListener('fetch', event => {
	//console.log('Fetch interecepted for: ', event.request.url);
	event.respondWith(
		caches.match(event.request).then(cachedResponse => {
			if (cachedResponse) {
				return cachedResponse;
			}
			return fetch(event.request);
		})
	);
})
self.addEventListener('activate', event => {
	event.waitUntil(
		caches.keys().then(keyList => {
			return Promise.all(
				keyList.map(key => {
					if (key !== cacheversion){
						return caches.delete(key);
					}
				})
			)
		})
	);
});
