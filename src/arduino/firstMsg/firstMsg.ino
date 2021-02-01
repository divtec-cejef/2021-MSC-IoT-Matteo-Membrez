#include <SigFox.h>
#include "DHT.h"

#define DHTPIN 2

#define DHTTYPE DHT11

typedef struct __attribute__ ((packed)) sigfox_message { // see http://www.catb.org/esr/structure-packing/#_structure_alignment_and_padding
  int16_t moduleTemperature;
} SigfoxMessage;

// stub for message which will be sent
SigfoxMessage msg;

// =================== UTILITIES ===================
void reboot() {
  NVIC_SystemReset();
  while (1);
}
// =================================================

DHT dht(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(115200);
  while (!Serial);

  dht.begin();

  if (!SigFox.begin()) {
    Serial.println("SigFox error, rebooting");
    reboot();
  }

  delay(100); // Wait at least 30ms after first configuration

  // Enable debug prints and LED indication
  SigFox.debug();
  
  // Reading temperature or humidity takes about 250 milliseconds!
  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
  float h = dht.readHumidity();
  // Read temperature as Celsius (the default)
  float t = dht.readTemperature();
  // Read temperature as Fahrenheit (isFahrenheit = true)
  float f = dht.readTemperature(true);

  // Check if any reads failed and exit early (to try again).
  if (isnan(h) || isnan(t) || isnan(f)) {
    Serial.println(F("Failed to read from DHT sensor!"));
    return;
  }

  // Compute heat index in Fahrenheit (the default)
  float hif = dht.computeHeatIndex(f, h);
  // Compute heat index in Celsius (isFahreheit = false)
  float hic = dht.computeHeatIndex(t, h, false);

  Serial.print(F("Humidity: "));
  Serial.print(h);
  Serial.print(F("%  Temperature: "));
  Serial.print(t);
  Serial.print(F("°C\n"));

  // Clears all pending interrupts
  SigFox.status();
  delay(1);

  // Send the data
  SigFox.beginPacket();
  SigFox.print(t);
  SigFox.print("|");
  SigFox.print(h);

  Serial.print("Status: ");
  Serial.println(SigFox.endPacket());

  SigFox.end();
}

void loop() {}
