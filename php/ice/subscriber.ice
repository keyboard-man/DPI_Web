// **********************************************************************
//
// Copyright (c) 2003-2011 ZeroC, Inc. All rights reserved.
//
// This copy of Ice is licensed to you under the terms described in the
// ICE_LICENSE file included in this distribution.
//
// **********************************************************************

#ifndef SUBSCRIBER_ICE
#define SUBSCRIBER_ICE

module Subs
//module Demo
{

	sequence<int> McnnSrvTypeVector;
	enum  MANACTION
	{
		ADD,
		DEL,
		EDI
	};
	struct PubSubDpi
	{
		string id;
		string ip;
		string port;
		MANACTION manType;
	};
	sequence<PubSubDpi> ManDpiVector;

	interface McnnSubs
	//interface Clock
	{
		void subsMcnnSrvInfo(string nodeId,McnnSrvTypeVector srvType);
		void subsDpiInfo(ManDpiVector dpi);
		void subsStatInfo();
	};

};

#endif
