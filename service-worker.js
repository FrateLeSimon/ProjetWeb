self.addEventListener('install', (event) => {
    console.log('[Service Worker] Installation');
  });
  
  self.addEventListener('activate', (event) => {
    console.log('[Service Worker] Activation');
  });
  const CACHE_NAME = 'mon-cache-v1';
const CACHE_ASSETS = [
  '/',
  '/vitrine/page_vitrine.html',
  
];

self.addEventListener('install', (event) => {
  console.log('[Service Worker] Installation');

  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      console.log('[Service Worker] Mise en cache des ressources');
      return cache.addAll(CACHE_ASSETS);
    })
  );
});

self.addEventListener('activate', (event) => {
  console.log('[Service Worker] Activation');
});
