import type { CapacitorConfig } from '@capacitor/cli';

const config: CapacitorConfig = {
  appId: 'com.gmci.dispatch',
  appName: 'GMCI DISPATCH',
  webDir: 'public',
  server: {
    androidScheme: 'https',
    url: 'https://dispatch.gmci.my.id',
    allowNavigation: [
      'dispatch.gmci.my.id'
    ],
    cleartext: true
  }
};

export default config;
