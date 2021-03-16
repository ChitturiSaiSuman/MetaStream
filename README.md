# MetaStream

**Video-on-Demand Platform developed as Full Stack Mini Project**

Co-Developer: @github.com/300-iq

## 1. Introduction

### 1.1. Overview

Meta Stream is a Video on Demand Platform that enables people to stream high quality content. Users can choose from wide range of High-Quality Stock videos of different Genres. It also enables the Users to download the content.

We offer Users to

* Search from Wide-range of High-Quality Stock videos.
* Stream any Video at their preferred Resolution.
* Download videos.
* Manage their Activity such as Watch History, Search History and Download History.
* Contribute any Video Suggestions.

### 1.2. Motivation

The Search Feature in most of the existing Video on Demand Platforms is not satisfactory. This spoils the overall User Experience. This was the primary motivation for us to develop a Video on Demand Platform with enhanced Search Feature and a better overall User Experience. We also wanted to learn how Video-on-demand Platforms work. So, we wanted to develop a Video-on-demand platform which is Powerful and User-friendly.

### 1.3. Problem Definition

In most of the existing Video-on-demand Platforms, Users are constantly reporting about Inaccurate Search Results and finding it difficult to get their way around. So, this Project is developed with an Efficient Search Algorithm while also being User Friendly.

### 1.4. Objectives

* To improve the search feature on existing VOD's.
* To create a user-friendly interface, to enable users to navigate through the application without any difficulty.
* To give user the ability to like, dislike, download a video.
* To display video statistics like, views, likes, dislikes, downloads, with real-time updating.
* To provide hassle-free direct downloads to user, without redirection to third party sites.

### 1.5. Scope

Meta Stream is a Video-on-Demand Platform that enables people to stream High- Quality content. Users can download the content and add Videos to their Watch-list. Users can also choose from wide range of high-quality Stock videos of different Genre.

### 2.1. User Classes and Characteristics

* Typical Users, who are looking for some Entertainment.
* Programmers who are interested in working on the project by further developing it or fix existing bugs.

### 2.2. Operating Environment

* Operating System
    1. Windows
    2. Linux
* Application Server
    1. Apache Tomcat v9.0
* Media Server
    1. Google Cloud
* Database
    1. MySQL

### 2.3. Design and Implementation Constraints

- The Application uses modular design where every feature is wrapped into a separate
module and the modules depend on each other through well-written APIs. There are several
APIs available to make plugin development easy.

    - 2.3.1. Frontend
        - The Frontend is implemented using HTML, CSS and Java Script.

    - 2.3.2. Backend
        - 2.3.2.1 Backend Application
            The Backend consists of server-side application designed using Java/Python that serves requests of clients.
        - 2.3.2.2. Database
            Database used is MySQL. It is used for storing User Information and Content Information.
        - 2.3.2.3. Server
            Server used is Apache Tomcat v9.0
        - 2.3.2.4. Storage
            The application uses Google Cloud Storage to store media.

### 2.4. User Documentation

Online help and FAQs are provided in the User Documentation

### 2.5. Assumptions and Dependencies

* Media streams are working fine.
* Streams and server have enough bandwidth.
* System has low latency.
* Video processing and networking libraries are available on the system.

## 3. Interfaces

### 3.1. Hardware Interfaces

- Streaming in 1080P FHD
    - Processor: 2.4Ghz (dual core) or 3.5Ghz (single Core) processor.
    - Graphics: Nvidia/ATi having bare minimum 256MB Video RAM and core clock 600Mhz.
- Streaming in 2160P UHD
    - Processor: 2.6Ghz (dual core) or 4.0Ghz (single Core) processor.
    - Graphics: Nvidia/ATi having bare minimum 512MB Video RAM and core clock 1.0Ghz.

### 3.2. Software Interfaces

- JavaScript must be enabled for browser playback.
- Popup and Ad-blockers can inhibit playback.
- Flash: 15 or higher.
- Browser: Internet Explorer 9.0 or later, Mozilla Firefox 17 or later, Google Chrome 36 or later, Safari 5.0 or later.

### 3.4. Communication Interfaces

Our Application uses both streaming protocols and HTTP-based protocols. Streaming protocols like Real-Time Messaging Protocol (RTMP) enable speedy video delivery using dedicated streaming servers, whereas HTTP-based protocols rely on regular web servers to optimize the viewing experience and quickly scale

#### Data Flow Diagram
![Data Flow Diagram](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Structure.png)

## 4. Activities
The following list specifies User Activities while using our Application.

- User Registration: In order to use our Application, user must have an Account.
- User Login: To continue using the application, user mush Log In.
- User Log out: User can log out of the application anytime.
- Watch a Video: User can select and watch any video from wide range of Stock Videos.
- Search a Video: User can Search any Video of his/her choice using the Search feature provided in the Application.
- Like or Dislike a Video: User can wish to Like or Dislike a Video.
- Download a Video: If User wants to save Videos Offline, he/she can download using the Download Feature.
- Manage Credentials: User can alter his/her Login Credentials anytime.
- Manage Activity: User can View or delete his/her Account Activity such as Watch History, Search History and Download History.
- Contribute: User can contribute Video Ideas or Suggestions and the Admin team will try to upload the Video at the earliest.

## 5. Dependencies
- Google Drive API (Node JS)
- MYSQL Database
- XAMPP Server
- Slick JS
- Bootstrap
- JQuery

## 6. Results
- 6.1. Home Page (Before Login)

![Home Page(before Login)](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Screenshots/screencapture-localhost-Meta-Stream-home-index-php-2020-12-19-20_49_34.png)

- 6.2. Sign up

![Sign up](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Screenshots/screencapture-localhost-Meta-Stream-signup-signup-php-2020-12-19-20_54_10.png)

- 6.3. Verify Account

![Verify Account](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Screenshots/screencapture-localhost-Meta-Stream-signup-verify-php-2020-12-19-20_59_19.png)

- 6.4. Login Form

![Login Form](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Screenshots/screencapture-localhost-Meta-Stream-home-index-php-2020-12-19-21_00_18.png)

- 6.5. Home Page (After Login)

![Home Page(After Login)](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Screenshots/screencapture-localhost-Meta-Stream-home-index-php-2020-12-19-21_05_00.png)

- 6.6. Home Page (When Explored)

![Home Page(When Explored)](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Screenshots/screencapture-localhost-Meta-Stream-home-index-php-2020-12-19-21_07_03.png)

- 6.7. Video Playback page

![Video Playback Page](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Screenshots/screencapture-localhost-Meta-Stream-home-videoplayback-php-2020-12-19-21_08_58.png)

- 6.8. Search Results Page with Results

![Search Results](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Screenshots/screencapture-localhost-Meta-Stream-home-search-php-2020-12-19-21_22_06.png)

- 6.9. Search Results Page with 0 Results

![0 Search Results](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Screenshots/screencapture-localhost-Meta-Stream-home-search-php-2020-12-19-21_24_01.png)

- 6.10. My Account Dashboard

![My Account Dashboard](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Screenshots/screencapture-localhost-Meta-Stream-myaccount-dashboard-php-2020-12-19-21_28_29.png)

- 6.11. Manage Credentials

![Manage Credentials](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Screenshots/screencapture-localhost-Meta-Stream-myaccount-account-myaccount-php-2020-12-19-21_30_15.png)

- 6.12. Manage Search History

![Manage Search History](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Screenshots/screencapture-localhost-Meta-Stream-myaccount-search-history-searchhistory-php-2020-12-19-21_41_20.png)

- 6.13. Manage Watch History

![Manage Watch History](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Screenshots/screencapture-localhost-Meta-Stream-myaccount-watch-history-watchhistory-php-2020-12-19-21_47_10.png)

- 6.14. Manage Download History

![Manage Download History](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Screenshots/screencapture-localhost-Meta-Stream-myaccount-download-history-downloadhistory-php-2020-12-19-21_49_52.png)

- 6.15. Home Page (after log out)

![After Log out](https://raw.githubusercontent.com/ChitturiSaiSuman/MetaStream/main/Docs/Screenshots/screencapture-localhost-Meta-Stream-home-index-php-2020-12-19-20_49_34.png)

## 7. Conclusion and Future Work

### 7.1. Conclusion

    The project “Meta Stream” has been developed as per the requirement specification. The complete functionality has been thoroughly tested, to eliminate bugs and enhance the user experience.

    The design, implementation and the output reports are presented in this project report. The entire project was meticulously designed to ensure seamless user experience and easier incorporation of future modules.

### 7.2. Future Work

    The goals of this project were purposely kept within what was believed to be attainable within the allotted timeline and resources. As such, many improvements can be made upon this initial design. That being said, it is felt that the design could be replicated to a much larger scale. The following are the features we wish to add in the future:

        - Incorporate ML to understand usage patterns of users and improve the recommendation algorithm
        - Introduce paid subscriptions which include access to exclusive content from leading content creators.
        - Improve the overall security of the platform, making it less vulnerable to data breaches.

## 8. References

- [1](https://stackoverflow.com)
- [2](https://www.w3schools.com)
- [3](https://codepen.io)
- [4](https://www.geeksforgeeks.org)
- [5](https://www.freecodecamp.org)
- [6](https://www.tutorialspoint.com)
- [7](https://www.javatpoint.com)
- [8](https://www.coursera.org)
- [9](https://www.udemy.com)
- [10](https://stackexchange.com)
- [11](https://developers.google.com/drive)
- [12](https://devdocs.io)
- [13](https://developer.mozilla.org/en-US/docs/Web)
- [14](https://tympanus.net/codrops/css_reference)
- [15](https://www.codecademy.com)