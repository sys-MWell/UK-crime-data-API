# Data Visualisation Application

## Project Overview
This project is a Data Visualisation Application developed as part of a Application Development Portfolio. The application provides an interactive and intuitive interface for visualising crime data, allowing users to analyse various crime statistics efficiently. The project focuses on using web technologies to create dynamic visualisations, integrate external datasets, and deliver a seamless user experience.

## Features
1. **Dynamic Graphs and Charts**:
   - Visual representations of crime statistics using interactive graphs and charts.
   - Data can be filtered and sorted by crime type, location, and time.

2. **RESTful API Integration**:
   - Retrieves and processes real-time crime data from an external API.
   - Supports querying data for specific parameters like region and crime category.

3. **User-Friendly Interface**:
   - Simplified navigation with HTML and CSS styling.
   - Accessible and responsive design for various devices.

4. **Data Management**:
   - Crime data is processed and displayed in an easy-to-understand format.
   - Integration with a backend database to store and retrieve information as needed.

5. **Error Handling**:
   - Validation mechanisms for user input and API responses to prevent incorrect or incomplete data visualisation.

## Technologies Used
- **Frontend**:
  - HTML5, CSS3, and JavaScript.
  - Data visualisation libraries for rendering charts (e.g., Chart.js or equivalent).
- **Backend**:
  - PHP for server-side scripting.
  - MySQL for database operations.
- **Other Tools**:
  - Apache server for hosting.
  - RESTful API for external data integration.

## Folder Structure
- **Content/**: Contains assets and resources used throughout the application.
- **libs/**: Holds external libraries and dependencies.
- **Scripts/**: Includes JavaScript files for dynamic functionality and interactivity.
- **.htaccess**: Configuration file for URL rewriting and server rules.
- **api.php**: Script to handle API requests and data retrieval.
- **CrimeDataRestService.php**: Core backend service for managing crime data.
- **dbinfo.php**: Database configuration file.
- **graph.html**: Frontend for displaying data visualisations.
- **index.html**: Main entry point for the application.
- **KnifeCrime.php**: Module for managing and displaying knife crime data.
- **map.html**: Page for displaying geographical crime data on an interactive map.
- **RestService.php**: Generic service for REST API handling.
- **styles.css**: Styling for the application.

## How to Run the Application
1. **Setup Environment**:
   - Install a local web server (e.g., XAMPP or WAMP) to host the application.
   - Place the project folder in the server's root directory (e.g., `htdocs` for XAMPP).

2. **Configure Database**:
   - Import the provided SQL database file into MySQL.
   - Update `dbinfo.php` with database credentials.

3. **Run the Application**:
   - Start local server.
   - Access the application in your browser at `http://localhost/<project-folder-name>/index.html`.

4. **API Configuration**:
   - Ensure the external API is accessible for fetching live crime data.
   - Update `CrimeDataRestService.php` and `RestService.php` with the API key and endpoint details if required.

## Key Files Explained
- **CrimeDataRestService.php**: Handles data retrieval and formatting for crime-related statistics.
- **graph.html**: Displays dynamic charts using JavaScript and integrates data fetched from the backend.
- **map.html**: Implements an interactive map visualisation for spatial crime data analysis.
- **KnifeCrime.php**: Focuses on a specific category of crime, providing detailed analysis and charts.
- **styles.css**: Custom CSS for layout and design consistency.

## Challenges and Solutions
1. **API Integration**:
   - Challenge: Managing inconsistent API data formats.
   - Solution: Added robust error handling and data validation in the backend.

2. **Data Visualisation**:
   - Challenge: Rendering large datasets efficiently.
   - Solution: Used optimised JavaScript libraries and data aggregation techniques.

3. **Cross-Browser Compatibility**:
   - Challenge: Ensuring consistent behavior across different browsers.
   - Solution: Tested extensively and used modern, standards-compliant libraries.
  
## Screenshots
![image](https://github.com/user-attachments/assets/abadc1e7-532b-4d83-98e8-223c07632915)
*Figure 1: Display all data*
![image](https://github.com/user-attachments/assets/64cc1c6b-f56c-4202-bec6-a6c3f14b049c)
*Figure 2: Quantity filter*
![image](https://github.com/user-attachments/assets/3aad9ac4-e804-4d9e-9ccf-af8d9caffc74)
*Figure 3: Data filter*
![image](https://github.com/user-attachments/assets/19d73e87-9ec4-496d-92dd-a09916913b02)
*Figure 4: Edit crime details*
![image](https://github.com/user-attachments/assets/6b4fc3c5-20d6-48a4-9a0e-fcacf09a6349)  
*Figure 5: Total knife crime graphs*
![image](https://github.com/user-attachments/assets/04354592-b495-4b1f-98a7-6b9a816d71e2)
*Figure 6: Bar chart*
![image](https://github.com/user-attachments/assets/28a7ca5e-d6a9-488a-b1ac-6eae50bac2b0)
*Figure 7: Doughnut graph*
![image](https://github.com/user-attachments/assets/c8e4de7b-a9c9-490e-93e9-467831117489)
*Figure 8: Doughnut graph – police force removed*
![image](https://github.com/user-attachments/assets/3de76369-44e7-4c5e-a93e-21d556f5541a)
*Figure 9: OSM standard layer*
![image](https://github.com/user-attachments/assets/56604ff7-70c2-42f2-a08a-097fd96b3fa8)
*Figure 10: OSM Humaniarian layer*
![image](https://github.com/user-attachments/assets/95cc027e-8387-4b02-bde1-da3b5a7438e0)
*Figure 11: StamenTerrain layer*
![image](https://github.com/user-attachments/assets/0ed1ee8d-dc06-40b0-b510-e28e462c76f5)
*Figure 12: Region selection*
![image](https://github.com/user-attachments/assets/7ae00582-915d-4de3-8312-6b4fa0e77321)
*Figure 13: Map zoom*

