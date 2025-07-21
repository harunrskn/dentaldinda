self.addEventListener('install', function (e) {
    e.waitUntil(
        caches.open('dental-cache').then(function (cache) {
            return cache.addAll([
                '/',
                '/css/app.css',
                '/js/app.js',
                '/manifest.json',
                '/images/icons/icon-192x192.png',
                '/images/icons/icon-512x512.png'
            ]);
        })
    );
});

self.addEventListener('fetch', function (e) {
    e.respondWith(
        caches.match(e.request).then(function (response) {
            return response || fetch(e.request);
        })
    );
});
  