# MetaStream
**Video-on-Demand Platform developed as Full Stack Mini Project** 
## 1. Introduction
### 1.1. Overview
Meta Stream is a Video on Demand Platform that enables people to stream high
quality content. Users can choose from wide range of High-Quality Stock videos of
different Genres. It also enables the Users to download the content.
We offer Users to
* Search from Wide-range of High-Quality Stock videos.
* Stream any Video at their preferred Resolution.
* Download videos.
* Manage their Activity such as Watch History, Search History and Download History.
* Contribute any Video Suggestions.
### 1.2. Motivation
The Search Feature in most of the existing Video on Demand Platforms is not
satisfactory. This spoils the overall User Experience. This was the primary motivation
for us to develop a Video on Demand Platform with enhanced Search Feature and a better
overall User Experience. We also wanted to learn how Video-on-demand Platforms
work. So, we wanted to develop a Video-on-demand platform which is Powerful and
User-friendly.
### 1.3. Problem Definition
In most of the existing Video-on-demand Platforms, Users are constantly reporting
about Inaccurate Search Results and finding it difficult to get their way around. So, this
Project is developed with an Efficient Search Algorithm while also being User Friendly.
### 1.4. Objectives
* To improve the search feature on existing VOD's.
* To create a user-friendly interface, to enable users to navigate through the application without any difficulty.
* To give user the ability to like, dislike, download a video.
* To display video statistics like, views, likes, dislikes, downloads, with real-time updating.
* To provide hassle-free direct downloads to user, without redirection to third party sites.
### 1.5. Scope
Meta Stream is a Video-on-Demand Platform that enables people to stream High-
Quality content. Users can download the content and add Videos to their Watch-list.
Users can also choose from wide range of high-quality Stock videos of different Genre.

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