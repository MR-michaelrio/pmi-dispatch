import type { CapacitorConfig } from '@capacitor/cli';

const config: CapacitorConfig = {
  appId: 'com.alaqsho.dispatch',
  appName: 'Al-Aqsho DISPATCH',
  webDir: 'public',
  server: {
    androidScheme: 'https',
    url: 'https://alaqsho.my.id',
    allowNavigation: [
      'alaqsho.my.id'
    ],
    cleartext: true
  }
};

export default config;
