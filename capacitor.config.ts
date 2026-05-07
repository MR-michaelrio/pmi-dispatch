import type { CapacitorConfig } from '@capacitor/cli';

const config: CapacitorConfig = {
  appId: 'com.alaqsho.dispatch',
  appName: 'Al-Aqsho DISPATCH',
  webDir: 'public',
  server: {
    androidScheme: 'https',
    url: 'https://al-aqsho.dispatcher.web.id/',
    allowNavigation: [
      'al-aqsho.dispatcher.web.id'
    ],
    cleartext: true
  }
};

export default config;
