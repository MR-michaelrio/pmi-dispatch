import type { CapacitorConfig } from '@capacitor/cli';

const config: CapacitorConfig = {
  appId: 'com.gmci.dispatch',
  appName: 'PMI Kabupaten Bekasi DISPATCH',
  webDir: 'public',
  server: {
    androidScheme: 'https',
    url: 'https://dispatch.gmci.or.id',
    allowNavigation: [
      'dispatch.gmci.or.id'
    ],
    cleartext: true
  }
};

export default config;
