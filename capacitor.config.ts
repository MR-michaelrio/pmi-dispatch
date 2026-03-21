import type { CapacitorConfig } from '@capacitor/cli';

const config: CapacitorConfig = {
  appId: 'com.pmikabbekasi.dispatch',
  appName: 'PMI Kabupaten Bekasi DISPATCH',
  webDir: 'public',
  server: {
    androidScheme: 'https',
    url: 'https://pmi.my.id',
    allowNavigation: [
      'pmi.my.id'
    ],
    cleartext: true
  }
};

export default config;
