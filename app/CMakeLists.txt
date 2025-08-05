cmake_minimum_required(VERSION 3.30)

project(baseWorldReader)

set(CMAKE_CXX_STANDARD 20)

find_package(yaml-cpp CONFIG REQUIRED)

set(SOURCES 
    src/world.cpp
)


add_executable(gen_map ${SOURCES} src/gen_map.cpp)

target_link_libraries(gen_map PRIVATE 
    yaml-cpp::yaml-cpp
)