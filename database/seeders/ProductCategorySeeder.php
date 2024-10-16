<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Acoustic Doppler Current Profilers (ADCPs)',
                'slug' => 'acoustic-doppler-current-profilers-adcps',
                'description' => 'Devices for measuring water current velocities over a depth range using the Doppler effect.'
            ],
            [
                'name' => 'AIS (Automatic Identification System)',
                'slug' => 'ais-automatic-identification-system',
                'description' => 'AIS is a tracking system used for collision avoidance and identifying vessels on the water.'
            ],
            [
                'name' => 'Anchoring Systems',
                'slug' => 'anchoring-systems',
                'description' => 'Anchoring systems for safely securing vessels to the seabed or moorings.'
            ],
            [
                'name' => 'Antennas',
                'slug' => 'antennas',
                'description' => 'Various types of antennas for marine communication and navigation systems.'
            ],
            [
                'name' => 'Autopilots',
                'slug' => 'autopilots',
                'description' => 'Marine autopilots for hands-free steering and navigation.'
            ],
            [
                'name' => 'Battery Chargers',
                'slug' => 'battery-chargers',
                'description' => 'Battery charging systems designed to maintain marine battery banks.'
            ],
            [
                'name' => 'Bilge Pump Systems',
                'slug' => 'bilge-pump-systems',
                'description' => 'Systems for removing bilge water from the boat’s hull.'
            ],
            [
                'name' => 'Cable Management Systems',
                'slug' => 'cable-management-systems',
                'description' => 'Solutions for organizing and securing cabling in marine environments.'
            ],
            [
                'name' => 'Chartplotters',
                'slug' => 'chartplotters',
                'description' => 'Devices that combine GPS data with electronic navigation charts for marine navigation.'
            ],
            [
                'name' => 'Communication Systems',
                'slug' => 'communication-systems',
                'description' => 'Marine communication devices such as radios, satellite phones, and intercoms.'
            ],
            [
                'name' => 'Converters (DC-DC)',
                'slug' => 'dc-dc-converters',
                'description' => 'Devices that convert electrical power between different DC voltages for marine electronics.'
            ],
            [
                'name' => 'Depth Sounders',
                'slug' => 'depth-sounders',
                'description' => 'Instruments used to measure water depth below the boat.'
            ],
            [
                'name' => 'Docking Systems',
                'slug' => 'docking-systems',
                'description' => 'Electronic systems designed to assist with the docking of vessels.'
            ],
            [
                'name' => 'Electrical Panels',
                'slug' => 'electrical-panels',
                'description' => 'Control panels used to distribute electrical power throughout the boat.'
            ],
            [
                'name' => 'Electrical Protection Devices',
                'slug' => 'electrical-protection-devices',
                'description' => 'Devices that protect electrical circuits from damage caused by overcurrent or voltage spikes.'
            ],
            [
                'name' => 'Electronic Chart Display and Information Systems (ECDIS)',
                'slug' => 'electronic-chart-display-and-information-systems-ecdis',
                'description' => 'Electronic navigation systems that provide continuous positioning of a vessel.'
            ],
            [
                'name' => 'Emergency Beacons (EPIRB)',
                'slug' => 'emergency-beacons-epirb',
                'description' => 'Emergency Position Indicating Radio Beacons used to alert search and rescue services.'
            ],
            [
                'name' => 'Engine Monitoring Systems',
                'slug' => 'engine-monitoring-systems',
                'description' => 'Systems designed to monitor engine performance and diagnose issues.'
            ],
            [
                'name' => 'Fuel Monitoring Systems',
                'slug' => 'fuel-monitoring-systems',
                'description' => 'Devices that track fuel usage and efficiency for marine vessels.'
            ],
            [
                'name' => 'Galvanic Isolators',
                'slug' => 'galvanic-isolators',
                'description' => 'Devices used to prevent corrosion by isolating DC currents in the marine environment.'
            ],
            [
                'name' => 'Generators (Marine)',
                'slug' => 'marine-generators',
                'description' => 'Power generators specifically designed for marine applications.'
            ],
            [
                'name' => 'GPS Systems',
                'slug' => 'gps-systems',
                'description' => 'Global Positioning System devices for marine navigation.'
            ],
            [
                'name' => 'Gyrocompasses',
                'slug' => 'gyrocompasses',
                'description' => 'Navigational instruments that indicate true north using the Earth’s rotation.'
            ],
            [
                'name' => 'Horns and Signal Systems',
                'slug' => 'horns-signal-systems',
                'description' => 'Marine horns and signaling devices used for communication and navigation.'
            ],
            [
                'name' => 'Instrument Displays (Multifunction Displays)',
                'slug' => 'instrument-displays',
                'description' => 'Multifunction displays used to show data from various marine instruments.'
            ],
            [
                'name' => 'Inverters (DC-AC)',
                'slug' => 'dc-ac-inverters',
                'description' => 'Devices that convert DC power to AC for use in marine environments.'
            ],
            [
                'name' => 'LED Lighting',
                'slug' => 'led-lighting',
                'description' => 'Energy-efficient LED lighting solutions for boats and marine environments.'
            ],
            [
                'name' => 'Magnetic Compasses',
                'slug' => 'magnetic-compasses',
                'description' => 'Traditional compasses used to find direction at sea.'
            ],
            [
                'name' => 'Marine Audio Systems',
                'slug' => 'marine-audio-systems',
                'description' => 'High-quality audio systems designed specifically for marine environments.'
            ],
            // More categories can be added here with unique descriptions and slugs...
            
    [
        'name' => 'Marine Batteries',
        'slug' => 'marine-batteries',
        'description' => 'Batteries specifically designed for use in marine environments, providing reliable power.'
    ],
    [
        'name' => 'Marine Cameras (CCTV, IR, and night vision)',
        'slug' => 'marine-cameras',
        'description' => 'Marine-grade cameras used for security, navigation, and monitoring systems.'
    ],
    [
        'name' => 'Marine Communication Radios (VHF, SSB, etc.)',
        'slug' => 'marine-communication-radios',
        'description' => 'VHF, SSB, and other communication radios used for marine communication.'
    ],
    [
        'name' => 'Marine Monitoring Systems (Remote Monitoring)',
        'slug' => 'marine-monitoring-systems',
        'description' => 'Systems designed to remotely monitor various parameters and statuses of a marine vessel.'
    ],
    [
        'name' => 'Marine Navigation Software',
        'slug' => 'marine-navigation-software',
        'description' => 'Software tools used for planning and navigating marine routes with precision.'
    ],
    [
        'name' => 'Marine Radars',
        'slug' => 'marine-radars',
        'description' => 'Radar systems designed to detect other vessels, landmasses, and weather conditions.'
    ],
    [
        'name' => 'Marine Solar Panels',
        'slug' => 'marine-solar-panels',
        'description' => 'Solar panels designed to provide renewable energy to marine vessels.'
    ],
    [
        'name' => 'Marine Wi-Fi Systems',
        'slug' => 'marine-wifi-systems',
        'description' => 'Wi-Fi systems tailored to provide internet access on boats and yachts.'
    ],
    [
        'name' => 'Masthead Lighting Systems',
        'slug' => 'masthead-lighting-systems',
        'description' => 'Lighting systems mounted on the masthead of a boat for visibility and signaling.'
    ],
    [
        'name' => 'NMEA Networking Devices',
        'slug' => 'nmea-networking-devices',
        'description' => 'Devices that facilitate communication between marine electronics using NMEA standards.'
    ],
    [
        'name' => 'Power Distribution Systems',
        'slug' => 'power-distribution-systems',
        'description' => 'Systems designed to distribute electrical power throughout a vessel safely and efficiently.'
    ],
    [
        'name' => 'Power Management Systems',
        'slug' => 'power-management-systems',
        'description' => 'Systems that monitor and control the power supply and distribution on a vessel.'
    ],
    [
        'name' => 'Radar Reflectors',
        'slug' => 'radar-reflectors',
        'description' => 'Devices that enhance the visibility of a vessel on radar screens by reflecting radar signals.'
    ],
    [
        'name' => 'Remote Control Systems (Marine)',
        'slug' => 'remote-control-systems',
        'description' => 'Remote control systems used to control various marine devices from a distance.'
    ],
    [
        'name' => 'Rudder Angle Indicators',
        'slug' => 'rudder-angle-indicators',
        'description' => 'Instruments that show the angle of the rudder for better steering control.'
    ],
    [
        'name' => 'Satellite Communication Systems',
        'slug' => 'satellite-communication-systems',
        'description' => 'Systems that enable communication via satellite from marine vessels.'
    ],
    [
        'name' => 'Satellite TV Systems',
        'slug' => 'satellite-tv-systems',
        'description' => 'Systems that provide television reception on vessels via satellite connections.'
    ],
    [
        'name' => 'Searchlights',
        'slug' => 'searchlights',
        'description' => 'Powerful lights used to illuminate areas around a vessel for navigation or safety.'
    ],
    [
        'name' => 'Security Systems (Boat alarms and sensors)',
        'slug' => 'security-systems',
        'description' => 'Alarm and sensor systems used to protect boats from theft and unauthorized access.'
    ],
    [
        'name' => 'Shore Power Systems',
        'slug' => 'shore-power-systems',
        'description' => 'Electrical systems that allow boats to connect to power supplies onshore.'
    ],
    [
        'name' => 'Sonar Systems',
        'slug' => 'sonar-systems',
        'description' => 'Systems used to detect objects underwater and measure depth using sound waves.'
    ],
    [
        'name' => 'Speed Loggers',
        'slug' => 'speed-loggers',
        'description' => 'Devices that measure and record the speed of a vessel over water.'
    ],
    [
        'name' => 'Spotlights',
        'slug' => 'spotlights',
        'description' => 'Powerful lights used to focus light in a specific area on or around a vessel.'
    ],
    [
        'name' => 'Stabilizers (Gyro Stabilizers)',
        'slug' => 'stabilizers',
        'description' => 'Stabilization systems designed to reduce the rolling motion of a vessel in rough seas.'
    ],
    [
        'name' => 'Steering Systems',
        'slug' => 'steering-systems',
        'description' => 'Systems that provide control over the steering and maneuvering of a vessel.'
    ],
    [
        'name' => 'Tank Monitoring Systems',
        'slug' => 'tank-monitoring-systems',
        'description' => 'Systems that monitor the levels of fuel, water, and other fluids in marine tanks.'
    ],
    [
        'name' => 'Thrusters (Bow and Stern)',
        'slug' => 'thrusters',
        'description' => 'Bow and stern thrusters used to maneuver vessels in tight spaces.'
    ],
    [
        'name' => 'Underwater Lights',
        'slug' => 'underwater-lights',
        'description' => 'Lighting systems used to illuminate areas underwater around a vessel.'
    ],
    [
        'name' => 'UPS (Uninterruptible Power Supply)',
        'slug' => 'ups-uninterruptible-power-supply',
        'description' => 'Backup power systems that provide temporary power during outages.'
    ],
    [
        'name' => 'VHF Radios',
        'slug' => 'vhf-radios',
        'description' => 'Very High Frequency radios used for short-range communication between vessels.'
    ],
    [
        'name' => 'Voltage Regulators',
        'slug' => 'voltage-regulators',
        'description' => 'Devices that maintain a constant voltage level to protect marine electronics.'
    ],
    [
        'name' => 'Watermakers (Desalination systems)',
        'slug' => 'watermakers-desalination-systems',
        'description' => 'Systems that convert seawater into potable freshwater for use on boats.'
    ],
    [
        'name' => 'Weather Stations',
        'slug' => 'weather-stations',
        'description' => 'Instruments that measure various weather conditions such as wind, temperature, and pressure.'
    ],
    [
        'name' => 'Wind Instruments (Anemometers)',
        'slug' => 'wind-instruments',
        'description' => 'Instruments that measure wind speed and direction for sailing and navigation.'
    ],
    [
        'name' => 'Windlasses (Anchoring systems)',
        'slug' => 'windlasses',
        'description' => 'Mechanical devices used to raise and lower anchors on a vessel.'
    ]

        ];

        foreach ($categories as $category) {
            ProductCategory::create([
                'is_online' => true, // Set online status to true or customize as needed
                'name' => $category['name'],
                'category_slug' => $category['slug'],
                'description' => $category['description'],
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);
        }
    }
}