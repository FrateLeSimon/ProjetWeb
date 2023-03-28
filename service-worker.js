

const cacheName = 'cts-pwa';
const filesToCache = [
  './pages/index.php',
  './assets/CSS/style.css',
  './assets/img/logoSquare.png',
  './manifest.json'
];

self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(cacheName)
      .then(function(cache) {
        return cache.addAll(filesToCache);
      })
  );
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request)
      .then(function(response) {
        if (response) {
          return response;
        }
        return fetch(event.request);
      })
  );
});
self.addEventListener('activate', (event) => {
  console.log('[Service Worker] Activation');
});


self.addEventListener('fetch', (event) => {
    console.log('[Service Worker] Récupération', event.request.url);
  
    event.respondWith(
      caches.match(event.request).then((response) => {
        return response || fetch(event.request);
      })
    );
  });