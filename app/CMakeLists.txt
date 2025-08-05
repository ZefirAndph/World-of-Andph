cmake_minimum_required(VERSION 3.30)

project(baseWorldReader)

set(CMAKE_CXX_STANDARD 20)

set(SOURCES 
    
)

add_executable(world ${SOURCES} src/gen_map.cpp)

find_package(yaml-cpp CONFIG REQUIRED)

target_link_libraries(world PRIVATE yaml-cpp::yaml-cpp)