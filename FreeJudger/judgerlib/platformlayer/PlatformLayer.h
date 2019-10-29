﻿

#ifndef IMUST_OJ_PLATFORM_LAYER_H
#define IMUST_OJ_PLATFORM_LAYER_H

#include "PlatformConfig.h"

#include <string>
#include <iostream>
#include <fstream>
#include <cassert>

#include <Windows.h>

namespace IMUST
{
#define OJAPI

typedef             std::wstring                    OJString;
typedef             wchar_t                         OJChar_t;

typedef             std::wifstream                  OJIfstream;
typedef             std::wofstream                  OJOfstream;

#define OJCh(ch)            L##ch
#define OJStr(str)          L##str
#define GetOJString(str)    ::IMUST::OJString(OJStr(str)) 

#define OJCout      std::wcout
#define OJCerr      std::wcerr

typedef             short                           OJInt16_t;
typedef             int                             OJInt32_t;
typedef             long long                       OJInt64_t;
typedef             float                           OJFloat16_t;
typedef             double                          OJFloat32_t;
typedef             unsigned short                  OJUInt16_t;
typedef             unsigned int                    OJUInt32_t;
typedef             unsigned long long              OJUInt64_t;

#define OJSprintf   swprintf
#define OJSscanf    swscanf
#define OJSleep     Sleep

#define JUDGER_SAFE_DELETE_OBJ_AND_RESET(obj)       \
    if ((obj))                                      \
    {                                               \
        delete (obj);                               \
        (obj) = 0;                                  \
    }

#define SAFE_CLOSE_HANDLE_AND_RESET(handle) \
    if (handle)                             \
    {                                       \
        CloseHandle((handle));              \
        (handle) = NULL;                    \
    }

#define DEBUG_MSG   OutputDebugStringW


const OJString EmptyString;

}




#endif  // IMUST_OJ_PLATFORM_LAYER_H

